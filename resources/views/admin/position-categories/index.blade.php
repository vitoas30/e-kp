@extends('layouts.admin')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Position Categories</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Position Categories</li>
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
                        <input type="text" id="searchCategories" class="form-control form-control-solid w-250px ps-13" placeholder="Search categories..." />
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
                        
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Add Category
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_categories" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-gray-800">
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-200px">Description</th>
                                <th class="min-w-100px">Count Position</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>
                                        <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $category->name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-700">{{ $category->description ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-700 mb-1 fs-6">{{ $category->positions_count }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-info btn-sm" title="Setting" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-solid ki-gear fs-5 m-0"></i>
                                            <i class="ki-duotone ki-down fs-5 m-0"></i>
                                        </a>

                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-5 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}" class="menu-link px-3 text-warning">
                                                    <i class="ki-duotone ki-pencil fs-5 me-1 text-warning">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" class="menu-link px-3 text-danger deleteAlert" title="Delete" data-url="{{route('admin.position.category.destroy', $category->id)}}">
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

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModal{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-3">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title text-white" id="editCategoryModal{{ $category->id }}">
                                                    <i class="ki-duotone ki-pencil fs-2 me-2 text-white">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    Update Position Category
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.position.category.update', $category->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <label for="name{{ $category->id }}" class="form-label fw-semibold required">Category Name</label>
                                                        <input type="text" name="name" id="name{{ $category->id }}" class="form-control form-control-solid" placeholder="Enter category name" value="{{ $category->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description{{ $category->id }}" class="form-label fw-semibold">Description</label>
                                                        <textarea name="description" id="description{{ $category->id }}" class="form-control form-control-solid" rows="3" placeholder="Enter description (optional)">{{ $category->description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="ki-duotone ki-check fs-2"></i>
                                                        Update Category
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                {{-- Empty state handled by JavaScript --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Category Modal --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="addCategoryModalLabel">
                    <i class="ki-duotone ki-plus fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Add Position Category
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.position.category.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold required">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Enter category name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description" class="form-control form-control-solid" rows="3" placeholder="Enter description (optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let dataTable = null;
    const hasData = {{ $categories->count() > 0 ? 'true' : 'false' }};

    function initDataTable() {
        const tableElement = $('#kt_table_categories');
        if (!tableElement.length) return;
        
        // Destroy existing instance if exists
        if ($.fn.DataTable.isDataTable('#kt_table_categories')) {
            $('#kt_table_categories').DataTable().destroy();
        }
        
        // Only initialize DataTable if there's data
        if (hasData) {
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
                    emptyTable: "No categories available",
                    info: "Showing _START_ to _END_ of _TOTAL_ categories",
                    infoEmpty: "Showing 0 to 0 of 0 categories",
                    infoFiltered: "(filtered from _MAX_ total categories)",
                    lengthMenu: "Show _MENU_",
                    zeroRecords: "No matching categories found",
                    paginate: {
                        first: '<i class="ki-duotone ki-double-left fs-2"><span class="path1"></span><span class="path2"></span></i>',
                        last: '<i class="ki-duotone ki-double-right fs-2"><span class="path1"></span><span class="path2"></span></i>',
                        next: '<i class="ki-duotone ki-right fs-2"></i>',
                        previous: '<i class="ki-duotone ki-left fs-2"></i>'
                    }
                },
                columnDefs: [
                    { targets: 3, orderable: false, searchable: false },
                    { targets: 0, searchable: true },
                    { targets: 1, searchable: true },
                    { targets: 2, searchable: false }
                ],
                drawCallback: function() {
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                }
            });

            // Custom Search Handler
            $('#searchCategories').on('keyup', function() {
                dataTable.search(this.value).draw();
            });

            $('#exportButton').on('click', function() {
                const btn = $(this);
                const originalHtml = btn.html();
                btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Exporting...').prop('disabled', true);

                try {
                    // Get filtered data from DataTable
                    const data = dataTable.rows({ search: 'applied' }).data();
                    
                    // Build Excel HTML content
                    let tableRows = '';
                    
                    // Add data rows
                    data.each(function(row) {
                        const name = $(row[0]).find('span').text().trim();
                        const description = $(row[1]).find('span').text().trim() || '-';
                        const count = $(row[2]).find('span').text().trim();
                        
                        tableRows += '<tr>' +
                            '<td>' + escapeHtml(name) + '</td>' +
                            '<td>' + escapeHtml(description) + '</td>' +
                            '<td class="number">' + escapeHtml(count) + '</td>' +
                            '</tr>';
                    });
                    
                    // Create full HTML structure
                    const excelContent = 
                        '<html xmlns:o="urn:schemas-microsoft-com:office:office" ' +
                        'xmlns:x="urn:schemas-microsoft-com:office:excel" ' +
                        'xmlns="http://www.w3.org/TR/REC-html40">' +
                        '<head>' +
                        '<meta charset="utf-8">' +
                        '<style>' +
                        'table { border-collapse: collapse; width: 100%; }' +
                        'th { background-color: #4472C4; color: white; font-weight: bold; padding: 10px; border: 1px solid #ddd; text-align: left; }' +
                        'td { padding: 8px; border: 1px solid #ddd; }' +
                        '.number { mso-number-format: "0"; text-align: center; }' +
                        '</style>' +
                        '</head>' +
                        '<body>' +
                        '<table>' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Name</th>' +
                        '<th>Description</th>' +
                        '<th>Count Position</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>' +
                        tableRows +
                        '</tbody>' +
                        '</table>' +
                        '</body>' +
                        '</html>';

                    // Create blob and download
                    const blob = new Blob([excelContent], { 
                        type: 'application/vnd.ms-excel;charset=utf-8;' 
                    });
                    
                    const link = document.createElement('a');
                    const url = URL.createObjectURL(blob);
                    const filename = 'positions-' + new Date().toISOString().split('T')[0] + '.xls';
                    
                    link.setAttribute('href', url);
                    link.setAttribute('download', filename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);

                    // Show success message
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Export Successful',
                            text: 'Data has been exported to Excel',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }

                } catch (error) {
                    console.error('Export error:', error);
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Export Failed',
                            text: 'Failed to export data. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        alert('Failed to export data. Please try again.');
                    }
                }

                // Reset button state
                setTimeout(() => {
                    btn.html(originalHtml).prop('disabled', false);
                }, 1000);
            });

            // Helper function to escape HTML
            function escapeHtml(text) {
                const map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };
                return String(text).replace(/[&<>"']/g, m => map[m]);
            }
        } else {
            // Show empty state if no data
            tableElement.find('tbody').html(`
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        <div class="d-flex flex-column align-items-center">
                            <i class="ki-outline ki-information-5 fs-3x mb-3"></i>
                            <span class="fw-semibold fs-5">No categories found.</span>
                            <span class="text-muted fs-7">Start by adding a new category</span>
                        </div>
                    </td>
                </tr>
            `);

            // Disable search and export when empty
            $('#searchCategories').prop('disabled', true);
            $('#exportButton').prop('disabled', true);
        }
    }

    // Initialize when DOM is ready
    $(document).ready(function() {
        initDataTable();

        // Delete Handler with class selector instead of id
        $(document).on('click', '.deleteAlert', function(e) {
            e.preventDefault();
            const url = $(this).data('url');

            Swal.fire({
                title: 'Anda yakin untuk menghapus category ini?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = url;
                }
            });
        });

        // Success Notification
        @if(session('success'))
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { 
                    confirmButton: "btn btn-primary" 
                }
            });
        @endif

        // Error Notification
        @if(session('error'))
            Swal.fire({
                text: "{{ session('error') }}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: { 
                    confirmButton: "btn btn-primary" 
                }
            });
        @endif
    });
</script>
@endpush