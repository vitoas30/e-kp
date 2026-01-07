@extends('layouts.admin')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Inventory Service Requests</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Service Requests</li>
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
                        <input type="text" id="searchService" class="form-control form-control-solid w-250px ps-13" placeholder="Search request..." />
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_services" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-gray-800">
                                <th class="min-w-100px">Date</th>
                                <th class="min-w-150px">User</th>
                                <th class="min-w-150px">Item</th>
                                <th class="min-w-200px">Description</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px">Cost</th>
                                <th class="min-w-100px">Proof</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($service->request_date)->format('d M Y') }}</td>
                                    <td>{{ $service->user->name }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $service->item->name }}</span><br>
                                        <span class="text-muted fs-7">{{ $service->item->code }}</span>
                                    </td>
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
                                    <td>
                                        @if($service->proof_of_payment)
                                            <a href="{{ asset($service->proof_of_payment) }}" target="_blank" class="btn btn-icon btn-sm btn-light-info">
                                                <i class="ki-duotone ki-picture fs-4"><span class="path1"></span><span class="path2"></span></i>
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#updateServiceModal{{ $service->id }}">
                                            Update Status
                                        </button>
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
</div>

@foreach($services as $service)
<div class="modal fade" id="updateServiceModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Service Request #{{ $service->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.inventory.services.update', $service->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Requester</label>
                        <input type="text" class="form-control" value="{{ $service->user->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Item</label>
                        <input type="text" class="form-control" value="{{ $service->item->name }} ({{ $service->item->code }})" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" disabled>{{ $service->description }}</textarea>
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
                        <input type="number" name="cost" class="form-control" placeholder="Enter service cost (if reimbursable)" value="{{ $service->cost }}">
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
                        <textarea name="admin_note" class="form-control" rows="3" placeholder="Enter note or response...">{{ $service->admin_note }}</textarea>
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

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#searchService').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#kt_table_services tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endpush
