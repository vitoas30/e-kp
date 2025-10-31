@extends('layouts.admin')

@section('title', 'Info Allowance')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Info Allowance</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.users.index')}}" class="text-muted text-hover-primary">List User</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Info Allowance</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            @if(session()->has('message'))
                <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row p-5 mb-10">
                    <i class="ki-duotone ki-information fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h5 class="mb-1">Error</h5>
                        <span>{{ session()->get('message') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-3 text-danger"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-dismissible bg-light-success border border-success d-flex flex-column flex-sm-row p-5 mb-10">
                    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h5 class="mb-1">Success</h5>
                        <span>{{ session()->get('success') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-3 text-success"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
            @endif

            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    @include('admin.users.header')
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAllowanceModal">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Add Allowance
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive pt-5">
                        <table id="employeeTable" class="table table-row-dashed table-row-gray-300 mt-5">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Allowance Name</th>
                                    <th class="min-w-125px">Amount</th>
                                    <th class="min-w-125px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach($allowancesStatus as $detail)
                                <tr>
                                    <td class="w-200px">{{$detail->allowance->name ?? 'N/A'}}</td> {{-- Tambahkan null coalescing operator --}}
                                    <td>Rp {{ number_format($detail->custom_amount, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm" title="Setting" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-solid ki-gear fs-5 m-0"></i>
                                            <i class="ki-duotone ki-down fs-5 m-0"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-5 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editAllowenceModal{{ $detail->id }}" class="menu-link px-3 text-warning">
                                                    <i class="ki-duotone ki-pencil fs-5 me-1 text-warning"><span class="path1"></span><span class="path2"></span></i>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" class="menu-link px-3 text-danger deleteAlert" title="Delete" data-url="{{route('admin.users.allowance.destroy', $detail->id)}}">
                                                    <i class="ki-duotone ki-trash fs-5 text-danger me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAllowanceModal" tabindex="-1" aria-labelledby="addAllowanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="addAllowanceModalLabel">
                        <i class="ki-duotone ki-plus fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span></i>
                        Add Allowance
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.users.allowance.add', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="allowance_id_add" class="form-label fw-semibold required">Allowance</label>
                            <select id="allowance_id_add" name="allowance_id" class="form-select" data-placeholder="Select allowance" required> 
                                <option value="" disabled selected>Select Allowance</option>
                                @foreach ($allowances as $allowance)
                                    <option value="{{ $allowance->id }}" {{ old('allowance_id') == $allowance->id ? 'selected' : '' }}>
                                        {{ $allowance->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label fw-semibold">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input
                                    type="text"
                                    name="amount_display"
                                    id="salary_display"
                                    class="form-control"
                                    placeholder="Enter Amount"
                                    value="{{ old('amount') ? number_format((float) old('amount'), 0, ',', '.') : '' }}"
                                >
                            </div>
                            <input type="hidden" name="amount" id="salary" value="{{ old('amount') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-duotone ki-check fs-2"></i>
                            Save Allowance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($allowancesStatus as $detail)
        <div class="modal fade" id="editAllowenceModal{{ $detail->id }}" tabindex="-1" aria-labelledby="editAllowenceModalLabel{{ $detail->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg rounded-3">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-white" id="editAllowenceModalLabel{{ $detail->id }}">
                            <i class="ki-duotone ki-pencil fs-2 me-2 text-white"><span class="path1"></span><span class="path2"></span></i>
                            Edit Allowance
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.users.allowance.update', $detail->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-4">
                                <label for="allowance_{{ $detail->id }}" class="form-label fw-semibold required">Allowance</label>
                                <input type="text" name="allowance" id="allowance_{{ $detail->id }}" value="{{ $detail->allowance->name ?? 'N/A' }}" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="amount_display_{{ $detail->id }}" class="form-label fw-semibold">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input
                                        type="text"
                                        name="amount_display"
                                        id="amount_display_{{ $detail->id }}"
                                        class="form-control amount-display-input"
                                        placeholder="Enter Amount"
                                        value="{{ old('amount', $detail->custom_amount ? number_format((float) $detail->custom_amount, 0, ',', '.') : '') }}"
                                        data-target="amount_{{ $detail->id }}"
                                    >
                                </div>
                                <input type="hidden" name="amount" id="amount_{{ $detail->id }}" value="{{ old('amount', $detail->custom_amount) }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ki-duotone ki-check fs-2"></i>
                                Save Allowance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
<script>
    "use strict";
    $(document).ready(function() {
        if ($('#allowance_id_add').length) {
            if ($('#allowance_id_add').hasClass("select2-hidden-accessible")) {
                $('#allowance_id_add').select2('destroy');
            }
            
            $('#allowance_id_add').select2({
                placeholder: 'Pilih Employee Type',
                allowClear: true,
                minimumResultsForSearch: 0,
                width: '100%',
                dropdownParent: $('#addAllowanceModal'),
                escapeMarkup: function(markup) { return markup; },
                templateResult: function(data) {
                    return data.text;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });
        }

        

        let dataTable = null;
        const hasData = {{ $allowancesStatus->count() > 0 ? 'true' : 'false' }}; 

        function initDataTable() {
            const tableElement = $('#employeeTable');
            
            if (!tableElement.length) {
                console.error('Table element not found');
                return;
            }
            
            if ($.fn.DataTable.isDataTable('#employeeTable')) {
                tableElement.DataTable().destroy();
            }
            
            if (hasData) {
                try {
                    dataTable = tableElement.DataTable({
                        responsive: true,
                        searching: true,
                        info: true,
                        order: [[1, 'desc']],
                        pageLength: 10,
                        lengthChange: true,
                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        language: {
                            emptyTable: "No employee status available",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                            infoEmpty: "Showing 0 to 0 of 0 entries",
                            infoFiltered: "(filtered from _MAX_ total entries)",
                            lengthMenu: "Show _MENU_ entries",
                            zeroRecords: "No matching records found",
                            paginate: {
                                first: '&laquo;',
                                last: '&raquo;',
                                next: '&rsaquo;',
                                previous: '&lsaquo;'
                            }
                        },
                        columnDefs: [
                            { targets: 2, orderable: false, searchable: false },
                            { targets: '_all', searchable: true } 
                        ],
                        drawCallback: function() {
                            if (typeof KTMenu !== 'undefined') {
                                KTMenu.createInstances();
                            }
                        }
                    });

                } catch (error) {
                    console.error('DataTable initialization error:', error);
                }
            }
        }

        initDataTable();

        $(document).on('click', '.deleteAlert', function(e) {
            e.preventDefault();
            const url = $(this).data('url');

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim form DELETE
                        const form = document.createElement('form');
                        form.method = 'GET';
                        form.action = url;
                        
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';
                        
                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            } else {
                 if (confirm('Are you sure you want to delete this employee status?')) {
                    // Fallback jika SweetAlert tidak tersedia
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            }
        });
    });
</script>
@endpush