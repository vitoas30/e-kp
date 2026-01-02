<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\InventoryService;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\CategoryItem;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class InventoryController extends Controller
{
    private function checkPermission()
    {
        $user = Auth::user();
        if (!$user->position || !$user->position->category_id) {
            return false;
        }

        $menu = Menu::where('name', 'LIKE', '%Inventaris%')->first();

        if (!$menu) {
            return false;
        }

        $permissions = Permission::where('menu_id', $menu->id)
            ->where('position_id', $user->position->category_id)
            ->pluck('name')
            ->toArray();

        // Check if user has any of the management permissions (GET, POST, PUT, DELETE)
        $managementPermissions = ['GET', 'POST', 'PUT', 'DELETE'];
        
        return !empty(array_intersect($managementPermissions, $permissions));
    }

    // Helper to find users with specific inventory permissions
    private function getUsersWithInventoryPermissions()
    {
        $menu = Menu::where('name', 'LIKE', '%Inventaris%')->first();
        if (!$menu) return collect();

        // Find permissions for Inventaris that have GET/POST/PUT/DELETE
        $permissions = Permission::where('menu_id', $menu->id)
                                ->whereIn('name', ['GET', 'POST', 'PUT', 'DELETE'])
                                ->get();
        
        $positionCategoryIds = $permissions->pluck('position_id')->unique();

        // Find users who have these position categories
        // User -> Position -> Category
        return User::whereHas('position', function($q) use ($positionCategoryIds) {
            $q->whereIn('category_id', $positionCategoryIds);
        })->get();
    }

    public function index()
    {
        $isAdminAccess = $this->checkPermission();

        $myItems = InventoryItem::where('user_id', Auth::id())->with('category')->get();
        $myServices = InventoryService::where('user_id', Auth::id())->with('item')->orderBy('created_at', 'desc')->get();

        $allItems = collect();
        $allServices = collect();
        $categories = collect();
        $users = collect();

        if ($isAdminAccess) {
            $allItems = InventoryItem::with(['category', 'user'])->get();
            $allServices = InventoryService::with(['item', 'user'])->orderBy('created_at', 'desc')->get();
            $categories = CategoryItem::all();
            $users = User::all();
        }

        return view('user.inventory.index', compact('myItems', 'myServices', 'isAdminAccess', 'allItems', 'allServices', 'categories', 'users'));
    }

    public function storeServiceRequest(Request $request)
    {
        $request->validate([
            'inventory_item_id' => 'required|exists:inventory_items,id',
            'description' => 'required|string',
            'cost' => 'nullable|numeric|min:0',
        ]);

        // Verify user owns the item
        $item = InventoryItem::find($request->inventory_item_id);
        if ($item->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'You can only request service for items assigned to you.');
        }

        $service = InventoryService::create([
            'inventory_item_id' => $request->inventory_item_id,
            'user_id' => Auth::id(),
            'request_date' => now(),
            'description' => $request->description,
            'cost' => $request->cost,
            'status' => 'Pending',
        ]);

        // Update item condition to Damaged
        $item->condition = 'Damaged';
        $item->save();

        // NOTIFY UPDATED: Notify Admins/Users with Permissions
        $privilegedUsers = $this->getUsersWithInventoryPermissions();
        // Exclude self if privileged to avoid notification spam to self (optional, keeps it cleaner)
        $privilegedUsers = $privilegedUsers->reject(function ($u) { return $u->id == Auth::id(); });

        Notification::send($privilegedUsers, new SystemNotification(
            'New Service Request',
            Auth::user()->name . " has requested service for " . $item->name,
            'info',
            route('user.inventory.index') . '#kt_tab_manage_requests'
        ));
        
        // Notify Admins by Role too (Just in case permission system misses someone, though requirements say based on permission)
        // But let's stick to permissions as requested.

        return redirect()->route('user.inventory.index')->with('success', 'Service request submitted successfully.');
    }

    public function completeService(Request $request, $id)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $service = InventoryService::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($service->status != 'Approved') {
            return redirect()->back()->with('error', 'You can only complete services that are in Approved status.');
        }

        if ($request->hasFile('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/proofs'), $filename);
            $service->proof_of_payment = 'uploads/proofs/' . $filename;
        }

        $service->status = 'Completed';
        $service->completion_date = now();
        $service->save();

        // Update item condition back to Good
        $item = $service->item;
        $item->condition = 'Good';
        $item->save();

        // Notify Admins about completion/proof upload
        $privilegedUsers = $this->getUsersWithInventoryPermissions();
        Notification::send($privilegedUsers, new SystemNotification(
            'Service Completed',
            Auth::user()->name . " has completed service & uploaded proof for " . $item->name,
            'success',
            route('user.inventory.index') . '#kt_tab_manage_requests'
        ));

        return redirect()->route('user.inventory.index')->with('success', 'Service marked as completed successfully.');
    }

    // --- Privileged Methods ---

    public function storeItem(Request $request)
    {
        if (!$this->checkPermission()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:inventory_items,code',
            'category_item_id' => 'required|exists:category_items,id',
            'purchase_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        InventoryItem::create($request->all() + ['condition' => 'Good']);

        return redirect()->route('user.inventory.index')->with('success', 'Item created successfully.');
    }

    public function updateItem(Request $request, $id)
    {
        if (!$this->checkPermission()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:inventory_items,code,' . $id,
            'category_item_id' => 'required|exists:category_items,id',
            'purchase_date' => 'required|date',
            'condition' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $item = InventoryItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('user.inventory.index')->with('success', 'Item updated successfully.');
    }

    public function destroyItem($id)
    {
        if (!$this->checkPermission()) {
            abort(403, 'Unauthorized action.');
        }

        $item = InventoryItem::findOrFail($id);
        $item->delete();

        return redirect()->route('user.inventory.index')->with('success', 'Item deleted successfully.');
    }

    public function updateServiceStatus(Request $request, $id)
    {
        if (!$this->checkPermission()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|string',
            'admin_note' => 'nullable|string',
            'cost' => 'nullable|numeric',
        ]);

        $service = InventoryService::findOrFail($id);
        $service->status = $request->status;
        $service->admin_note = $request->admin_note;
        $service->cost = $request->cost;
        
        if ($request->status == 'Completed' && !$service->completion_date) {
            $service->completion_date = now();
        }

        $service->save();

        // Update item condition based on service status
        $item = $service->item;
        if ($item) {
            if ($request->status == 'Approved') {
                $item->condition = 'In Service';
            } elseif ($request->status == 'Completed') {
                $item->condition = 'Good';
            } elseif ($request->status == 'Rejected' || $request->status == 'Pending') {
                $item->condition = 'Damaged';
            }
            $item->save();
        }

        // Notify User about Status Update
        if ($service->user_id && $service->user) {
            // Check if updater is not the user themselves (avoid self-notify)
            if ($service->user_id != Auth::id()) {
                $service->user->notify(new SystemNotification(
                    'Service Status Updated',
                    "Your request for '{$item->name}' is now {$request->status}.",
                    'info',
                    route('user.inventory.index') . '#kt_tab_my_inventory'
                ));
            }
        }

        return redirect()->route('user.inventory.index')->with('success', 'Service status updated successfully.');
    }
}
