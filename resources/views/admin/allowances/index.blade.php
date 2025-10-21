@extends('layouts.admin')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Allowance</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Allowance</li>
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
                        <input type="text" id="searchAllowance" class="form-control form-control-solid w-250px ps-13" placeholder="Search allowance..." />
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

                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAllowanceModal">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Add Allowance
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_allowance" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-gray-800">
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-200px">Amount</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allowances as $allowance)
                                <tr>
                                    <td>
                                        <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $allowance->name }}</span>
                                    </td>
                                    <td>
                                        @if (!is_null($allowance->amount))
                                            <span class="text-gray-700">Rp {{ number_format($allowance->amount, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-gray-700">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-info btn-sm" title="Setting" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-solid ki-gear fs-5 m-0"></i>
                                            <i class="ki-duotone ki-down fs-5 m-0"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-5 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editAllowanceModal{{ $allowance->id }}" class="menu-link px-3 text-warning">
                                                    <i class="ki-duotone ki-pencil fs-5 me-1 text-warning">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" class="menu-link px-3 text-danger deleteAlert" title="Delete" data-url="{{route('admin.allowance.destroy', $allowance->id)}}">
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
                                    <td colspan="3" class="text-center text-muted py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ki-outline ki-information-5 fs-3x mb-3"></i>
                                            <span class="fw-semibold fs-5">No allowance found.</span>
                                            <span class="text-muted fs-7">Start by adding a new allowance</span>
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

{{-- Add Allowance Modal --}}
<div class="modal fade" id="addAllowanceModal" tabindex="-1" aria-labelledby="addAllowanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="addAllowanceModalLabel">
                    <i class="ki-duotone ki-plus fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Add Allowance
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.allowance.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold required">Allowance Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Enter allowance name" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount_display" class="form-label fw-semibold required">Allowance Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" 
                                name="amount_display" 
                                id="amount_display" 
                                class="form-control form-control-solid" 
                                placeholder="0" 
                                value="{{ old('amount') ? number_format(old('amount'), 0, ',', '.') : '' }}" 
                                required>
                            <span class="input-group-text text-muted">/allowance</span>
                        </div>
                        <input type="hidden" name="amount" id="amount" value="{{ old('amount') }}">
                        <div class="form-text text-muted">Contoh: Rp 50.000 per allowance</div>
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

{{-- Edit Allowance Modals --}}
@foreach ($allowances as $allowance)
<div class="modal fade" id="editAllowanceModal{{ $allowance->id }}" tabindex="-1" aria-labelledby="editAllowanceModalLabel{{ $allowance->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white">
                    <i class="ki-duotone ki-pencil fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Update Allowance
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.allowance.update', $allowance->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="name_edit{{ $allowance->id }}" class="form-label fw-semibold required">Allowance Name</label>
                        <input type="text" name="name" id="name_edit{{ $allowance->id }}" class="form-control form-control-solid" placeholder="Enter allowance name" value="{{ $allowance->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount_edit_display{{ $allowance->id }}" class="form-label fw-semibold required">Allowance Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text"
                                name="amount_display_edit"
                                id="amount_edit_display{{ $allowance->id }}"
                                class="form-control form-control-solid allowance-edit-display"
                                placeholder="0"
                                value="{{ number_format($allowance->amount, 0, ',', '.') }}"
                                required>
                            <span class="input-group-text text-muted">/allowance</span>
                        </div>
                        <input type="hidden" name="amount" id="amount_edit{{ $allowance->id }}" value="{{ $allowance->amount }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Update Allowance
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
        let dataTable = null;
        const hasData = {{ $allowances->count() > 0 ? 'true' : 'false' }};

        function initDataTable() {
            const tableElement = $('#kt_table_allowance');

            if (!tableElement.length) {
                console.error('Table element not found');
                return;
            }
            
            // Destroy existing instance if exists
            if ($.fn.DataTable.isDataTable('#kt_table_allowance')) {
                $('#kt_table_allowance').DataTable().destroy();
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
                            emptyTable: "No allowances available",
                            info: "Showing _START_ to _END_ of _TOTAL_ allowances",
                            infoEmpty: "Showing 0 to 0 of 0 allowances",
                            infoFiltered: "(filtered from _MAX_ total allowances)",
                            lengthMenu: "Show _MENU_",
                            zeroRecords: "No matching allowances found",
                            paginate: {
                                first: '&laquo;',
                                last: '&raquo;',
                                next: '&rsaquo;',
                                previous: '&lsaquo;'
                            }
                        },
                        columnDefs: [
                            { targets: 2, orderable: false, searchable: false },
                            { targets: 0, searchable: true },
                            { targets: 1, searchable: true }
                        ],
                        drawCallback: function() {
                            // Reinitialize Metronic menu components
                            if (typeof KTMenu !== 'undefined') {
                                KTMenu.createInstances();
                            }
                        }
                    });

                    // Custom Search Handler
                    $('#searchAllowance').on('keyup', function() {
                        const searchValue = this.value;
                        dataTable.search(searchValue).draw();
                    });

                    // Export Handler
                    $('#exportButton').on('click', function() {
                        const btn = $(this);
                        const originalHtml = btn.html();
                        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Exporting...').prop('disabled', true);

                        try {
                            const data = dataTable.rows({ search: 'applied' }).data();
                            let csv = [['Name', 'Description'].join(',')];
                            
                            data.each(function(row) {
                                const name = $(row[0]).text().trim();
                                const description = $(row[1]).text().trim();
                                csv.push([
                                    '"' + name.replace(/"/g, '""') + '"',
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
                $('#searchAllowance').prop('disabled', true);
                $('#exportButton').prop('disabled', true);
            }
        }

        // Initialize DataTable
        initDataTable();

        // Delete Handler with SweetAlert
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
                // Fallback to native confirm if SweetAlert not loaded
                if (confirm('Are you sure you want to delete this allowance?')) {
                    window.location.href = url;
                }
            }
        });

        // Success Notification
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

        // Error Notification
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

        // Reset modal forms on close
        $('.modal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
        });

        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        function parseRupiah(rupiah) {
            return parseInt(rupiah.replace(/\./g, '').replace(/,/g, '')) || 0;
        }

        // Format saat mengetik
        $('#amount_display').on('input', function() {
            let value = $(this).val();
            let formatted = formatRupiah(value);
            $(this).val(formatted);
            $('#amount').val(parseRupiah(formatted));
        });

        // Format saat blur (pastikan nilai akhir bersih)
        $('#amount_display').on('blur', function() {
            let value = $(this).val();
            if (value) {
                let formatted = formatRupiah(value);
                $(this).val(formatted);
                $('#amount').val(parseRupiah(formatted));
            }
        });

        // Handle paste event
        $('#amount_display').on('paste', function(e) {
            setTimeout(() => {
                let value = $('#amount_display').val();
                let formatted = formatRupiah(value);
                $('#amount_display').val(formatted);
                $('#amount').val(parseRupiah(formatted));
            }, 10);
        });

        // Prevent input karakter non-angka
        $('#amount_display').on('keypress', function(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode < 48 || charCode > 57) {
                e.preventDefault();
            }
        });

        // Format Rupiah untuk semua edit fields
        $(document).on('keyup', '.allowance-edit-display', function() {
            const formatted = formatRupiah($(this).val());
            $(this).val(formatted);
            const cleanValue = parseRupiah($(this).val());
            const hiddenInput = $(this).closest('.mb-3').find('input[type="hidden"]');
            hiddenInput.val(cleanValue);
        });
    });
</script>
@endpush