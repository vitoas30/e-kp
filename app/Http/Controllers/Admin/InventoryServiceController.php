<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryService;
use Illuminate\Http\Request;

class InventoryServiceController extends Controller
{
    public function index()
    {
        $services = InventoryService::with(['item', 'user'])->orderBy('created_at', 'desc')->get();
        return view('admin.inventory.services.index', compact('services'));
    }

    public function update(Request $request, string $id)
    {
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

        // If service is approved/completed, maybe update item condition?
        // For now, just update service status.

        return redirect()->route('admin.inventory.services.index')->with('success', 'Service request updated successfully.');
    }
}
