@extends('layouts.admin')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Permission</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Permission</li>
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
                        <input type="text" id="searchPermission" class="form-control form-control-solid w-250px ps-13" placeholder="Search permission..." />
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" id="exportButton" class="btn btn-light-primary">
                            <i class="ki-duotone ki-exit-up fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Export
                        </button>

                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Add Permission
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_employee_type" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-gray-800">
                                <th class="min-w-150px">Menu</th>
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-150px">Position</th>
                                <th class="min-w-200px">Description</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $permission)
                                <tr>
                                    <td>
                                        <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $permission->menu?->name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $permission->name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $permission->position?->name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-700">{{ $permission->description ?? '-' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-info btn-sm" title="Setting" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-solid ki-gear fs-5 m-0"></i>
                                            <i class="ki-duotone ki-down fs-5 m-0"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-5 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editPermissionModal{{ $permission->id }}" class="menu-link px-3 text-warning">
                                                    <i class="ki-duotone ki-pencil fs-5 me-1 text-warning">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" class="menu-link px-3 text-danger deleteAlert" title="Delete" data-url="{{route('admin.permission.destroy', $permission->id)}}">
                                                    <i class="ki-duotone ki-trash fs-5 text-danger me-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyStateRow">
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ki-outline ki-information-5 fs-3x mb-3"></i>
                                            <span class="fw-semibold fs-5">No sub menu found.</span>
                                            <span class="text-muted fs-7">Start by adding a new sub menu</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Menu Modal --}}
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="addPermissionModalLabel">
                    <i class="ki-duotone ki-plus fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Add Permission
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="menu" class="form-label fw-semibold required">Menu</label>
                        <select id="menu" name="menu" class="form-select form-select-solid" required>
                            <option value="" disabled selected>Pilih Menu</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}" {{ old('menu') == $menu->id ? 'selected' : '' }}>{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold required">Permission Name</label>
                        <select id="name" name="name" class="form-select form-select-solid" required>
                            <option value="" disabled selected>Pilih Method</option>
                            @foreach ($methods as $method)
                                <option value="{{ $method->value }}" {{ old('name') == $method->value ? 'selected' : '' }}>{{ $method->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="position" class="form-label fw-semibold required">Position Category</label>
                        <select id="position" name="position[]" class="form-select form-select-solid" required multiple>
                            @foreach($positions as $position)
                                <option value="{{$position->id}}" {{ old('position') == $position->id ? 'selected' : '' }}>{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description" class="form-control form-control-solid" rows="3" placeholder="Enter description (optional)">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Save Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Employee Type Modals --}}
@foreach ($permissions as $permission)
<div class="modal fade" id="editPermissionModal{{ $permission->id }}" tabindex="-1" aria-labelledby="editPermissionModalLabel{{ $permission->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white">
                    <i class="ki-duotone ki-pencil fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Update Permission
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.permission.update', $permission->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="menu_edit{{ $permission->id }}" class="form-label fw-semibold required">Menu</label>
                        <select id="menu_edit{{ $permission->id }}" name="menu" class="form-select form-select-solid" required>
                            <option value="" disabled selected>Pilih Menu</option>
                            @foreach($menus as $menu)
                                <option value="{{$menu->id}}" {{ $permission->menu_id == $menu->id ? 'selected' : '' }}>{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name_edit{{ $permission->id }}" class="form-label fw-semibold required">Permission Name</label>
                        <select id="name_edit{{ $permission->id }}" name="name" class="form-select form-select-solid" required>
                            <option value="" disabled selected>Pilih Method</option>
                            @foreach ($methods as $method)
                                <option value="{{ $method->value }}" {{ $permission->name == $method->value ? 'selected' : '' }}>{{ $method->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="position_edit{{ $permission->id }}" class="form-label fw-semibold required">Position Category</label>
                        <select id="position_edit{{ $permission->id }}" name="position" class="form-select form-select-solid" required>
                            @foreach($positions as $position)
                                <option value="{{$position->id}}" {{ $permission->position_id == $position->id ? 'selected' : '' }}>{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description_edit{{ $permission->id }}" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description_edit{{ $permission->id }}" class="form-control form-control-solid" rows="3" placeholder="Enter description (optional)">{{ $permission->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Update Permission
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
        if ($('#menu').length) {
            if ($('#menu').hasClass("select2-hidden-accessible")) {
                $('#menu').select2('destroy');
            }
            
            $('#menu').select2({
                placeholder: 'Pilih Menu',
                allowClear: true,
                minimumResultsForSearch: 0,
                width: '100%',
                dropdownParent: $('#addPermissionModal'),
                escapeMarkup: function(markup) { return markup; },
                templateResult: function(data) {
                    return data.text;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });
        }
        
        if ($('#name').length) {
            if ($('#name').hasClass("select2-hidden-accessible")) {
                $('#name').select2('destroy');
            }
            
            $('#name').select2({
                placeholder: 'Pilih Method',
                allowClear: true,
                minimumResultsForSearch: 0,
                width: '100%',
                dropdownParent: $('#addPermissionModal'),
                escapeMarkup: function(markup) { return markup; },
                templateResult: function(data) {
                    return data.text;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });
        }
        
        if ($('#position').length) {
            if ($('#position').hasClass("select2-hidden-accessible")) {
                $('#position').select2('destroy');
            }
            
            $('#position').select2({
                placeholder: 'Pilih Position Category',
                allowClear: true,
                minimumResultsForSearch: 0,
                width: '100%',
                dropdownParent: $('#addPermissionModal'),
                escapeMarkup: function(markup) { return markup; },
                templateResult: function(data) {
                    return data.text;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });
        }

        // Initialize Select2 for Edit Modals
        @foreach ($permissions as $permission)
            if ($('#menu_edit{{ $permission->id }}').length) {
                $('#menu_edit{{ $permission->id }}').select2({
                    placeholder: 'Pilih Menu',
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    width: '100%',
                    dropdownParent: $('#editPermissionModal{{ $permission->id }}'),
                    escapeMarkup: function(markup) { return markup; },
                    templateResult: function(data) {
                        return data.text;
                    },
                    templateSelection: function(data) {
                        return data.text;
                    }
                });
            }
            if ($('#name_edit{{ $permission->id }}').length) {
                $('#name_edit{{ $permission->id }}').select2({
                    placeholder: 'Pilih Method',
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    width: '100%',
                    dropdownParent: $('#editPermissionModal{{ $permission->id }}'),
                    escapeMarkup: function(markup) { return markup; },
                    templateResult: function(data) {
                        return data.text;
                    },
                    templateSelection: function(data) {
                        return data.text;
                    }
                });
            }
            if ($('#position_edit{{ $permission->id }}').length) {
                $('#position_edit{{ $permission->id }}').select2({
                    placeholder: 'Pilih Position Category',
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    width: '100%',
                    dropdownParent: $('#editPermissionModal{{ $permission->id }}'),
                    escapeMarkup: function(markup) { return markup; },
                    templateResult: function(data) {
                        return data.text;
                    },
                    templateSelection: function(data) {
                        return data.text;
                    }
                });
            }
        @endforeach
        // ===== DATATABLE INITIALIZATION =====
        let dataTable = null;
        const hasData = {{ $permissions->count() > 0 ? 'true' : 'false' }};

        function initDataTable() {
            const tableElement = $('#kt_table_employee_type');
            
            if (!tableElement.length) {
                console.error('Table element not found');
                return;
            }
            
            // Destroy existing instance if exists
            if ($.fn.DataTable.isDataTable('#kt_table_employee_type')) {
                $('#kt_table_employee_type').DataTable().destroy();
            }
            
            // Only initialize DataTable if there's data
            if (hasData) {
                try {
                    dataTable = tableElement.DataTable({
                        responsive: true,
                        searching: true,
                        info: true,
                        order: [[0, 'asc']],
                        pageLength: 10,
                        lengthChange: true,
                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        language: {
                            emptyTable: "No sub menu available",
                            info: "Showing _START_ to _END_ of _TOTAL_ sub menu",
                            infoEmpty: "Showing 0 to 0 of 0 sub menu",
                            infoFiltered: "(filtered from _MAX_ total sub menu)",
                            lengthMenu: "Show _MENU_",
                            zeroRecords: "No matching sub menu found",
                            paginate: {
                                first: '&laquo;',
                                last: '&raquo;',
                                next: '&rsaquo;',
                                previous: '&lsaquo;'
                            }
                        },
                        columnDefs: [
                            { targets: 2, orderable: false, searchable: false },
                            { targets: [0, 1, 2], searchable: true }
                        ],
                        drawCallback: function() {
                            // Reinitialize Metronic menu components
                            if (typeof KTMenu !== 'undefined') {
                                KTMenu.createInstances();
                            }
                        }
                    });

                    // Custom Search Handler
                    $('#searchEmployeeType').on('keyup', function() {
                        dataTable.search(this.value).draw();
                    });

                    // Export Handler
                    $('#exportButton').on('click', function() {
                        const btn = $(this);
                        const originalHtml = btn.html();
                        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Exporting...').prop('disabled', true);

                        try {
                            const data = dataTable.rows({ search: 'applied' }).data();
                            let csv = [['Name', 'Has End Date', 'Duration', 'Description'].join(',')];
                            
                            data.each(function(row) {
                                const name = $(row[0]).text().trim();
                                const hasEndDate = $(row[1]).text().trim();
                                const duration = $(row[2]).text().trim();
                                const description = $(row[3]).text().trim();
                                
                                csv.push([
                                    '"' + name.replace(/"/g, '""') + '"',
                                    '"' + hasEndDate.replace(/"/g, '""') + '"',
                                    '"' + duration.replace(/"/g, '""') + '"',
                                    '"' + description.replace(/"/g, '""') + '"'
                                ].join(','));
                            });

                            const csvContent = csv.join('\n');
                            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                            const link = document.createElement('a');
                            const url = URL.createObjectURL(blob);
                            
                            link.setAttribute('href', url);
                            link.setAttribute('download', 'employee-types-' + new Date().toISOString().split('T')[0] + '.csv');
                            link.style.visibility = 'hidden';
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        } catch (error) {
                            console.error('Export error:', error);
                            alert('Failed to export data. Please try again.');
                        }

                        setTimeout(() => {
                            btn.html(originalHtml).prop('disabled', false);
                        }, 1000);
                    });

                } catch (error) {
                    console.error('DataTable initialization error:', error);
                }
            } else {
                // Disable search and export when empty
                $('#searchEmployeeType').prop('disabled', true);
                $('#exportButton').prop('disabled', true);
            }
        }

        // Initialize DataTable
        initDataTable();

        // ===== DELETE HANDLER =====
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
                        window.location.href = url;
                    }
                });
            } else {
                if (confirm('Are you sure you want to delete this employee type?')) {
                    window.location.href = url;
                }
            }
        });

        // ===== SUCCESS/ERROR NOTIFICATIONS =====
        @if(session('success'))
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    text: "{{ session('success') }}",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: { 
                        confirmButton: "btn btn-primary" 
                    }
                });
            }
        @endif

        @if(session('error'))
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    text: "{{ session('error') }}",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: { 
                        confirmButton: "btn btn-primary" 
                    }
                });
            }
        @endif

        // ===== RESET FORMS ON MODAL CLOSE =====
        $('.modal').on('hidden.bs.modal', function () {
            const form = $(this).find('form')[0];
            if (form) {
                form.reset();
                // Reset duration visibility for add modal
                if ($(this).attr('id') === 'addEmployeeTypeModal') {
                    toggleDurationAdd();
                }
            }
        });
    });
</script>
@endpush