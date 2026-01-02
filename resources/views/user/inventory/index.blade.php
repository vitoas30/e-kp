@extends('layouts.user')

@section('content')
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    <!-- Statistics or Greeting -->
    <div class="col-12">
        <div class="card card-flush h-xl-100" style="background-color: #7239EA">
            <div class="card-header pt-5">
                <div class="card-title d-flex flex-column">
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $myItems->count() }}</span>
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">My Inventory Items</span>
                </div>
            </div>
            <div class="card-body d-flex align-items-end pt-0">
                <span class="text-white fw-bold fs-6">Items assigned to you</span>
            </div>
        </div>
    </div>
</div>

@if(isset($isAdminAccess) && $isAdminAccess)
<ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_my_inventory">My Inventory</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_manage_items">Manage All Items</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_manage_requests">Manage Service Requests</a>
    </li>
</ul>
@endif

<div class="tab-content" id="myTabContent">
    <!-- My Inventory Tab -->
    <div class="tab-pane fade show active" id="kt_tab_my_inventory" role="tabpanel">
        
        <!-- My Items -->
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3 class="fw-bold m-0">My Items</h3>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>Item Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Condition</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($myItems as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->category->name ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-light-{{ $item->condition == 'Good' ? 'success' : ($item->condition == 'In Service' ? 'primary' : 'warning') }}">
                                            {{ $item->condition }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#requestServiceModal{{ $item->id }}">
                                            Request Service
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No items assigned to you.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- My Recent Service Requests -->
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3 class="fw-bold m-0">My Service Requests</h3>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>Date</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Cost</th>
                                <th>Admin Note</th>
                                <th>Completion Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @forelse($myServices as $service)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($service->request_date)->format('d M Y') }}</td>
                                    <td>{{ $service->item->name }}</td>
                                    <td>{{ Str::limit($service->description, 50) }}</td>
                                    <td>
                                        @php
                                            $statusColor = match($service->status) {
                                                'Pending' => 'warning',
                                                'Approved' => 'primary',
                                                'Rejected' => 'danger',
                                                'Completed' => 'success',
                                                default => 'secondary'
                                            };
                                        @endphp
                                        <span class="badge badge-light-{{ $statusColor }}">{{ $service->status }}</span>
                                    </td>
                                    <td>
                                        @if($service->cost)
                                            Rp {{ number_format($service->cost, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $service->admin_note ?? '-' }}</td>
                                    <td>{{ $service->completion_date ? \Carbon\Carbon::parse($service->completion_date)->format('d M Y') : '-' }}</td>
                                    <td>
                                        @if($service->status == 'Approved')
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#completeServiceModal{{ $service->id }}">
                                                Complete
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No service requests found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(isset($isAdminAccess) && $isAdminAccess)
    <!-- Manage Items Tab -->
    <div class="tab-pane fade" id="kt_tab_manage_items" role="tabpanel">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3>All Inventory Items</h3>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_item">
                        <i class="ki-duotone ki-plus fs-2"></i> Add Item
                    </button>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_all_items" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Assigned To</th>
                                <th>Condition</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($allItems as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->category->name ?? '-' }}</td>
                                <td>{{ $item->user->name ?? 'Unassigned' }}</td>
                                <td>{{ $item->condition }}</td>
                                <td>
                                    <button class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_item{{ $item->id }}">Edit</button>
                                    <form action="{{ route('user.inventory.items.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light btn-active-light-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Manage Requests Tab -->
    <div class="tab-pane fade" id="kt_tab_manage_requests" role="tabpanel">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3>All Service Requests</h3>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_all_services" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="fw-bold text-gray-800">
                                <th>Date</th>
                                <th>User</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Cost</th>
                                <th>Proof</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($allServices as $service)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($service->request_date)->format('d M Y') }}</td>
                                <td>{{ $service->user->name }}</td>
                                <td>{{ $service->item->name }}</td>
                                <td><span class="badge badge-light-{{ $service->status == 'Pending' ? 'warning' : 'success' }}">{{ $service->status }}</span></td>
                                <td>{{ $service->cost ? 'Rp '.number_format($service->cost) : '-' }}</td>
                                <td>
                                    @if($service->proof_of_payment)
                                        <a href="{{ asset($service->proof_of_payment) }}" target="_blank" class="btn btn-icon btn-sm btn-light-info">
                                            <i class="ki-duotone ki-picture fs-4"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#updateAdminServiceModal{{ $service->id }}">
                                        Update
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- MODALS FOR MY INVENTORY --}}
@foreach($myItems as $item)
<div class="modal fade" id="requestServiceModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Service for {{ $item->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.inventory.service.store') }}" method="POST">
                @csrf
                <input type="hidden" name="inventory_item_id" value="{{ $item->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="description" class="form-label required">Description of Issue</label>
                        <textarea class="form-control" name="description" rows="3" required placeholder="Describe the problem..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Estimated Cost / Reimbursement Amount (Rp)</label>
                        <input type="number" class="form-control" name="cost" placeholder="Enter amount if known">
                        <div class="form-text">If you have already paid for the service, enter the amount for reimbursement.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach($myServices as $service)
    @if($service->status == 'Approved')
    <div class="modal fade" id="completeServiceModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Complete Service for {{ $service->item->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.inventory.service.complete', $service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Please upload the proof of payment (receipt) to mark this service as completed.
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Proof of Payment (Image)</label>
                            <input type="file" class="form-control" name="proof_of_payment" accept="image/*" required>
                            <div class="form-text">Allowed formats: jpeg, png, jpg, gif. Max size: 2MB.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Mark as Completed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endforeach

{{-- MODALS FOR ADMIN MANAGEMENT --}}
@if(isset($isAdminAccess) && $isAdminAccess)
<!-- Add Item Modal -->
<div class="modal fade" id="kt_modal_add_item" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Add New Item</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.inventory.items.store') }}" method="POST">
                @csrf
                <div class="modal-body py-10 px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Item Name</label>
                        <input type="text" class="form-control form-control-solid" name="name" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Code</label>
                        <input type="text" class="form-control form-control-solid" name="code" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Category</label>
                        <select class="form-select form-select-solid" name="category_item_id" required>
                            <option value="">Select Category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Purchase Date</label>
                        <input type="date" class="form-control form-control-solid" name="purchase_date" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Description</label>
                        <textarea class="form-control form-control-solid" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Item Modals -->
@foreach($allItems as $item)
<div class="modal fade" id="kt_modal_edit_item{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Edit Item</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.inventory.items.update', $item->id) }}" method="POST">
                @csrf
                <div class="modal-body py-10 px-lg-17">
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Item Name</label>
                        <input type="text" class="form-control form-control-solid" name="name" value="{{ $item->name }}" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Code</label>
                        <input type="text" class="form-control form-control-solid" name="code" value="{{ $item->code }}" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Category</label>
                        <select class="form-select form-select-solid" name="category_item_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $item->category_item_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Condition</label>
                        <select class="form-select form-select-solid" name="condition" required>
                            <option value="Good" {{ $item->condition == 'Good' ? 'selected' : '' }}>Good</option>
                            <option value="Damaged" {{ $item->condition == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                            <option value="In Service" {{ $item->condition == 'In Service' ? 'selected' : '' }}>In Service</option>
                            <option value="Lost" {{ $item->condition == 'Lost' ? 'selected' : '' }}>Lost</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Assigned User</label>
                        <select class="form-select form-select-solid" name="user_id">
                            <option value="">-- Unassigned --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $item->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Purchase Date</label>
                        <input type="date" class="form-control form-control-solid" name="purchase_date" value="{{ $item->purchase_date }}" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Description</label>
                        <textarea class="form-control form-control-solid" name="description">{{ $item->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Update Service Modals (Admin View) -->
@foreach($allServices as $service)
<div class="modal fade" id="updateAdminServiceModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Service Request #{{ $service->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.inventory.services.update', $service->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Requester: {{ $service->user->name }}</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Item: {{ $service->item->name }} ({{ $service->item->code }})</label>
                    </div>
                     <div class="mb-3">
                        <label class="form-label">Description: {{ $service->description }}</label>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label required">Status</label>
                        <select name="status" class="form-select">
                            <option value="Pending" {{ $service->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ $service->status == 'Approved' ? 'selected' : '' }}>Approve (In Process)</option>
                            <option value="Rejected" {{ $service->status == 'Rejected' ? 'selected' : '' }}>Reject</option>
                            <option value="Completed" {{ $service->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Service Cost (Rp)</label>
                        <input type="number" name="cost" class="form-control" placeholder="Enter service cost" value="{{ $service->cost }}">
                    </div>
                    @if($service->proof_of_payment)
                    <div class="mb-3">
                        <label class="form-label">Proof of Payment</label>
                        <div class="d-block">
                            <a href="{{ asset($service->proof_of_payment) }}" target="_blank">
                                <img src="{{ asset($service->proof_of_payment) }}" alt="Proof" class="img-fluid rounded border shadow-sm" style="max-height: 200px;">
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Admin Note</label>
                        <textarea name="admin_note" class="form-control" rows="3" placeholder="Enter response...">{{ $service->admin_note }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endif

@endsection

@push('scripts')
<script>
    @if(session('success'))
        Swal.fire({
            text: "{{ session('success') }}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn btn-primary" }
        });
    @endif
    @if(session('error'))
        Swal.fire({
            text: "{{ session('error') }}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: { confirmButton: "btn btn-primary" }
        });
    @endif

    $(document).ready(function() {
        $('#kt_table_all_items').DataTable();
         $('#kt_table_all_services').DataTable();

        // Check for hash in URL and switch tab
        var hash = window.location.hash;
        if (hash) {
            var triggerEl = document.querySelector('a[data-bs-toggle="tab"][href="' + hash + '"]');
            if (triggerEl) {
                var tab = new bootstrap.Tab(triggerEl);
                tab.show();
                // Also scroll to top if needed or keep position
            }
        }

        // Update hash when tab is clicked
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            history.pushState(null, null, e.target.hash);
        });
    });
</script>
@endpush
