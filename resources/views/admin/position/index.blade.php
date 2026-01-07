@extends('layouts.admin')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Position</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Position</li>
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
                        <input type="text" id="searchPosition" class="form-control form-control-solid w-250px ps-13" placeholder="Search position..." />
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
                        
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPositionModal">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Add Position
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                <div class="table-responsive">
                    <table id="kt_table_position" class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bold text-gray-800">
                                <th class="min-w-150px">Category</th>
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-200px">Description</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($positions as $position)
                                <tr>
                                    <td>
                                        <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $position->category?->name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-700 fw-bold mb-1 fs-6">{{ $position->name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-700">{{ $position->description ?? '-' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-info btn-sm" title="Setting" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-solid ki-gear fs-5 m-0"></i>
                                            <i class="ki-duotone ki-down fs-5 m-0"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-5 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editPositionModal{{ $position->id }}" class="menu-link px-3 text-warning">
                                                    <i class="ki-duotone ki-pencil fs-5 me-1 text-warning">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    Edit
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:void(0);" class="menu-link px-3 text-danger deleteAlert" title="Delete" data-url="{{route('admin.position.destroy', $position->id)}}">
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
                                {{-- Empty state will be handled by JavaScript --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Position Modal --}}
<div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="addPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="addPositionModalLabel">
                    <i class="ki-duotone ki-plus fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Add Position
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.position.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="category_id" class="form-label fw-semibold required">Category</label>
                        <select id="category_id" name="category_id" class="form-select form-select-solid" required>
                            <option value="" disabled selected>Pilih Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold required">Position Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Enter position name" value="{{ old('name') }}" required>
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
                        Save Position
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Position Modals --}}
@foreach ($positions as $position)
<div class="modal fade" id="editPositionModal{{ $position->id }}" tabindex="-1" aria-labelledby="editPositionModalLabel{{ $position->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white">
                    <i class="ki-duotone ki-pencil fs-2 me-2 text-white">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Update Position
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.position.update', $position->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="category_id_edit{{ $position->id }}" class="form-label fw-semibold required">Category</label>
                        <select id="category_id_edit{{ $position->id }}" name="category_id" class="form-select form-select-solid" required>
                            <option value="" disabled>Pilih Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ $position->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name_edit{{ $position->id }}" class="form-label fw-semibold required">Position Name</label>
                        <input type="text" name="name" id="name_edit{{ $position->id }}" class="form-control form-control-solid" placeholder="Enter position name" value="{{ $position->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description_edit{{ $position->id }}" class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="description_edit{{ $position->id }}" class="form-control form-control-solid" rows="3" placeholder="Enter description (optional)">{{ $position->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-check fs-2"></i>
                        Update Position
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
    $(document).ready(function() {
        // Initialize Select2 for Add Modal
        if ($('#category_id').length) {
            if ($('#category_id').hasClass("select2-hidden-accessible")) {
                $('#category_id').select2('destroy');
            }
            
            $('#category_id').select2({
                placeholder: 'Pilih Category',
                allowClear: true,
                minimumResultsForSearch: 0,
                width: '100%',
                dropdownParent: $('#addPositionModal'),
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
        @foreach ($positions as $position)
            if ($('#category_id_edit{{ $position->id }}').length) {
                $('#category_id_edit{{ $position->id }}').select2({
                    placeholder: 'Pilih Category',
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    width: '100%',
                    dropdownParent: $('#editPositionModal{{ $position->id }}'),
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

        // DataTable initialization
        let dataTable = null;
        const hasData = {{ $positions->count() > 0 ? 'true' : 'false' }};

        function initDataTable() {
            const tableElement = $('#kt_table_position');
            if (!tableElement.length) return;
            
            // Destroy existing instance if exists
            if ($.fn.DataTable.isDataTable('#kt_table_position')) {
                $('#kt_table_position').DataTable().destroy();
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
                        emptyTable: "No positions available",
                        info: "Showing _START_ to _END_ of _TOTAL_ positions",
                        infoEmpty: "Showing 0 to 0 of 0 positions",
                        infoFiltered: "(filtered from _MAX_ total positions)",
                        lengthMenu: "Show _MENU_",
                        zeroRecords: "No matching positions found",
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

                // Custom Search Handler - FIXED: menggunakan ID yang benar
                $('#searchPosition').on('keyup', function() {
                    dataTable.search(this.value).draw();
                });

                // Export Handler
                $('#exportButton').on('click', function() {
                    const btn = $(this);
                    const originalHtml = btn.html();
                    btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Exporting...').prop('disabled', true);

                    const data = dataTable.rows({ search: 'applied' }).data();
                    let csv = [['Name', 'Description'].join(',')];
                    
                    data.each(function(row) {
                        const name = $(row[0]).find('span').text().trim();
                        const description = $(row[1]).find('span').text().trim();
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
                    link.setAttribute('download', 'positions-' + new Date().toISOString().split('T')[0] + '.csv');
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    setTimeout(() => {
                        btn.html(originalHtml).prop('disabled', false);
                    }, 1000);
                });
            } else {
                // Show empty state if no data
                tableElement.find('tbody').html(`
                    <tr>
                        <td colspan="3" class="text-center text-muted py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="ki-outline ki-information-5 fs-3x mb-3"></i>
                                <span class="fw-semibold fs-5">No position found.</span>
                                <span class="text-muted fs-7">Start by adding a new position</span>
                            </div>
                        </td>
                    </tr>
                `);

                // Disable search and export when empty
                $('#searchPosition').prop('disabled', true);
                $('#exportButton').prop('disabled', true);
            }
        }

        // Initialize DataTable
        initDataTable();

        // Delete Handler
        $(document).on('click', '.deleteAlert', function(e) {
            e.preventDefault();
            const url = $(this).data('url');

            Swal.fire({
                title: 'Anda yakin untuk menghapus position ini?',
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