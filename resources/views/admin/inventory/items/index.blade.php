@extends('layouts.admin')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Inventory Items</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Inventory</li>
            </ul> 
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        @include('admin.errors')
        
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" id="searchItem" class="form-control form-control-solid w-250px ps-13" placeholder="Search item..." />
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Add Item
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_items" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-gray-800">
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-100px">Code</th>
                                <th class="min-w-100px">Category</th>
                                <th class="min-w-150px">Assigned To</th>
                                <th class="min-w-100px">Condition</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>
                                        <span class="text-gray-900 fw-bold mb-1 fs-6">{{ $item->name }}</span>
                                    </td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->category->name ?? '-' }}</td>
                                    <td>{{ $item->user->name ?? 'Unassigned' }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match($item->condition) {
                                                'Good' => 'badge-light-success',
                                                'Damaged' => 'badge-light-danger',
                                                'In Service' => 'badge-light-warning',
                                                default => 'badge-light-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $item->condition }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 m-0"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.inventory.items.destroy', $item->id) }}" class="menu-link px-3" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Item Modal --}}
<div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Inventory Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.inventory.items.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Code</label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_item_id" class="form-select" data-control="select2" data-placeholder="Select Category">
                                <option></option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Purchase Date</label>
                            <input type="date" name="purchase_date" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Item Modal --}}
@foreach($items as $item)
<div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Inventory Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.inventory.items.update', $item->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Code</label>
                            <input type="text" name="code" class="form-control" value="{{ $item->code }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_item_id" class="form-select" data-control="select2">
                                <option></option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $item->category_item_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Purchase Date</label>
                            <input type="date" name="purchase_date" class="form-control" value="{{ $item->purchase_date }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Condition</label>
                            <select name="condition" class="form-select">
                                <option value="Good" {{ $item->condition == 'Good' ? 'selected' : '' }}>Good</option>
                                <option value="Damaged" {{ $item->condition == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                                <option value="In Service" {{ $item->condition == 'In Service' ? 'selected' : '' }}>In Service</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Assign To User</label>
                            <select name="user_id" class="form-select" data-control="select2" data-placeholder="Select User">
                                <option value="">Unassigned</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $item->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $item->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#searchItem').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#kt_table_items tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endpush
