@extends('layouts.admin')

@push('style')
    <style>
        /* Styling untuk DataTable scroll */
        .dataTables_wrapper .dataTables_scroll {
            border: 1px solid #e4e6ef;
            border-radius: 4px;
        }

        .dataTables_scrollBody {
            border-top: 1px solid #e4e6ef !important;
        }

        /* Custom scrollbar styling */
        .dataTables_scrollBody::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .dataTables_scrollBody::-webkit-scrollbar-track {
            background: #f5f8fa;
            border-radius: 4px;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb {
            background: #b5b5c3;
            border-radius: 4px;
        }

        .dataTables_scrollBody::-webkit-scrollbar-thumb:hover {
            background: #7e8299;
        }

        /* Pastikan tabel mengisi penuh container */
        #kt_table_projects {
            margin-bottom: 0 !important;
        }

        /* Fixed header styling */
        .dataTables_scrollHead {
            background: #f9f9f9;
        }

        .dataTables_scrollHead th {
            background-color: #f9f9f9 !important;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        /* Prevent text wrapping di cells tertentu */
        .text-nowrap {
            white-space: nowrap !important;
        }
</style>
@endpush

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" id="searchProjects" class="form-control form-control-solid w-250px ps-13" placeholder="Search project" />
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
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-400 gs-5 gy-5 gx-5 table-hover align-middle w-100" id="kt_table_projects">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-100px">Code</th>
                                    <th class="min-w-125px">Leader</th>
                                    <th class="min-w-100px">Start Date</th>
                                    <th class="min-w-100px">End Date</th>
                                    <th class="min-w-100px">Status</th>
                                    <th class="min-w-100px">Priority</th>
                                    <th class="min-w-100px">Progress</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse ($projects as $project)
                                    <tr>
                                        <td><span class="text-gray-800 fw-bold text-nowrap">{{ $project->name }}</span></td>
                                        <td><span class="badge badge-light-info">{{ $project->code ?? '-' }}</span></td>

                                        {{-- Leader --}}
                                        <td>
                                            @if($project->manager)
                                                <div class="d-flex align-items-center text-nowrap">
                                                    <div class="symbol symbol-circle symbol-35px me-3">
                                                        <span class="symbol-label bg-light-primary text-primary fw-bold">
                                                            {{ strtoupper(substr($project->manager->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-gray-800">{{ $project->manager->name }}</span>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        {{-- Start Date --}}
                                        <td>
                                            <span class="text-nowrap">
                                                {{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : '-' }}
                                            </span>
                                        </td>

                                        {{-- End Date --}}
                                        <td>
                                            <span class="text-nowrap">
                                                {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : '-' }}
                                            </span>
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'planning' => 'warning',
                                                    'in_progress' => 'primary',
                                                    'on_hold' => 'danger',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger'
                                                ];
                                                $color = $statusColors[$project->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge badge-light-{{ $color }} text-nowrap">
                                                {{ ucwords(str_replace('_', ' ', $project->status ?? 'Unknown')) }}
                                            </span>
                                        </td>

                                        {{-- Priority --}}
                                        <td>
                                            @php
                                                $priorityColors = [
                                                    'low' => 'info',
                                                    'medium' => 'warning',
                                                    'high' => 'danger',
                                                    'urgent' => 'dark'
                                                ];
                                                $priorityColor = $priorityColors[$project->priority] ?? 'secondary';
                                            @endphp
                                            <span class="badge badge-light-{{ $priorityColor }}">
                                                {{ ucfirst($project->priority ?? '-') }}
                                            </span>
                                        </td>

                                        {{-- Progress --}}
                                        <td>
                                            <div class="d-flex align-items-center text-nowrap">
                                                <div class="progress h-6px w-100px me-2">
                                                    <div class="progress-bar bg-primary" 
                                                        role="progressbar" 
                                                        style="width: {{ (int) $project->progress }}%" 
                                                        aria-valuenow="{{ (int) $project->progress }}" 
                                                        aria-valuemin="0" 
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <span class="text-muted fs-7 fw-bold">{{ (int) $project->progress }}%</span>
                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-end">
                                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" 
                                            data-kt-menu-trigger="click" 
                                            data-kt-menu-placement="bottom-end">
                                                <i class="ki-solid ki-gear fs-5 ms-1"></i>
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                            </a>

                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.projects.show', $project->id) }}" class="menu-link px-3">
                                                        <i class="ki-solid ki-eye fs-5 me-2"></i>View
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="menu-link px-3">
                                                        <i class="ki-solid ki-pencil fs-5 me-2"></i>Edit
                                                    </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="javascript:void(0);" class="menu-link px-3 text-danger deleteAlert" 
                                                    data-url="{{ route('admin.projects.destroy', $project->id) }}">
                                                        <i class="ki-solid ki-trash fs-5 me-2"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-10">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="ki-outline ki-information-5 fs-3x mb-3"></i>
                                                <span class="fw-semibold fs-5">No projects found</span>
                                                <span class="text-muted fs-7 mt-2">Start by adding a new project</span>
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
@endsection

@push('scripts')
<script>
    let dataTable = null;
    const hasData = {{ $projects->count() > 0 ? 'true' : 'false' }};

    function initDataTable() {
        const tableElement = $('#kt_table_projects');
        if (!tableElement.length) return;

        if ($.fn.DataTable.isDataTable('#kt_table_projects')) {
            $('#kt_table_projects').DataTable().destroy();
        }

        if (hasData) {
            dataTable = tableElement.DataTable({
                responsive: false, // Matikan responsive untuk mengaktifkan scroll
                searching: true,
                info: true,
                order: [[0, 'asc']],
                pageLength: 10,
                lengthChange: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                
                // Konfigurasi scroll
                scrollX: true, // Scroll horizontal
                scrollY: '60vh', // Scroll vertical (sesuaikan tinggi sesuai kebutuhan)
                scrollCollapse: true, // Collapse scroll jika data sedikit
                fixedColumns: {
                    leftColumns: 2
                },
                
                // Layout tabel fillable
                autoWidth: false,
                
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                
                language: {
                    emptyTable: "No projects available",
                    info: "Showing _START_ to _END_ of _TOTAL_ projects",
                    infoEmpty: "Showing 0 to 0 of 0 projects",
                    infoFiltered: "(filtered from _MAX_ total projects)",
                    lengthMenu: "Show _MENU_",
                    zeroRecords: "No matching projects found",
                    paginate: {
                        first: '<i class="ki-duotone ki-double-left fs-2"></i>',
                        last: '<i class="ki-duotone ki-double-right fs-2"></i>',
                        next: '<i class="ki-duotone ki-right fs-2"></i>',
                        previous: '<i class="ki-duotone ki-left fs-2"></i>'
                    }
                },
                
                columnDefs: [
                    { targets: 8, orderable: false, searchable: false },
                    { targets: [0, 1, 2], orderable: true, searchable: true },
                    { targets: [3, 4, 5, 6, 7], orderable: true, searchable: false },
                    // Atur lebar kolom agar lebih rapi
                    { targets: 0, width: '20%' }, // Project Name
                    { targets: 1, width: '10%' }, // Code
                    { targets: 2, width: '15%' }, // Leader
                    { targets: 3, width: '10%' }, // Start Date
                    { targets: 4, width: '10%' }, // End Date
                    { targets: 5, width: '10%' }, // Status
                    { targets: 6, width: '10%' }, // Priority
                    { targets: 7, width: '10%' }, // Progress
                    { targets: 8, width: '5%' }   // Actions
                ],
                
                drawCallback: function() {
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                }
            });

            // 🔍 Search
            $('#searchProjects').on('keyup', function() {
                dataTable.search(this.value).draw();
            });

            // 📤 Export to Excel
            $('#exportButton').on('click', handleExport);

            function handleExport() {
                const btn = $(this);
                const originalHtml = btn.html();
                btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Exporting...').prop('disabled', true);

                try {
                    const data = dataTable.rows({ search: 'applied' }).data();
                    let tableRows = '';

                    data.each(function(row) {
                        const name = $(row[0]).text().trim();
                        const code = $(row[1]).text().trim();
                        const leader = $(row[2]).text().trim() || '-';
                        const startDate = $(row[3]).text().trim();
                        const endDate = $(row[4]).text().trim();
                        const status = $(row[5]).text().trim();
                        const priority = $(row[6]).text().trim();
                        const progress = $(row[7]).text().trim();

                        tableRows += `
                            <tr>
                                <td>${escapeHtml(name)}</td>
                                <td>${escapeHtml(code)}</td>
                                <td>${escapeHtml(leader)}</td>
                                <td>${escapeHtml(startDate)}</td>
                                <td>${escapeHtml(endDate)}</td>
                                <td>${escapeHtml(status)}</td>
                                <td>${escapeHtml(priority)}</td>
                                <td>${escapeHtml(progress)}</td>
                            </tr>`;
                    });

                    const excelContent = `
                        <html xmlns:o="urn:schemas-microsoft-com:office:office"
                            xmlns:x="urn:schemas-microsoft-com:office:excel"
                            xmlns="http://www.w3.org/TR/REC-html40">
                        <head>
                            <meta charset="utf-8">
                            <style>
                                table { border-collapse: collapse; width: 100%; }
                                th { background-color: #4472C4; color: white; font-weight: bold; padding: 10px; border: 1px solid #ddd; text-align: left; }
                                td { padding: 8px; border: 1px solid #ddd; }
                            </style>
                        </head>
                        <body>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Code</th>
                                        <th>Leader</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>${tableRows}</tbody>
                            </table>
                        </body>
                        </html>`;

                    const blob = new Blob([excelContent], { type: 'application/vnd.ms-excel;charset=utf-8;' });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = `projects-${new Date().toISOString().split('T')[0]}.xls`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    Swal?.fire({
                        icon: 'success',
                        title: 'Export Successful',
                        text: 'Project data has been exported to Excel',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } catch (error) {
                    console.error('Export error:', error);
                    Swal?.fire({
                        icon: 'error',
                        title: 'Export Failed',
                        text: 'Failed to export data. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }

                setTimeout(() => btn.html(originalHtml).prop('disabled', false), 1000);
            }

            function escapeHtml(text) {
                const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
                return String(text).replace(/[&<>"']/g, m => map[m]);
            }

            $('#searchProjects, #exportButton').prop('disabled', false);
        } else {
            $('#searchProjects, #exportButton').prop('disabled', true);
        }
    }

    $(document).ready(function() {
        initDataTable();

        // Delete Handler
        $(document).on('click', '.deleteAlert', function(e) {
            e.preventDefault();
            const url = $(this).data('url');

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
                    const form = $('<form>', {
                        'method': 'GET',
                        'action': url
                    });
                    
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': csrfToken
                    }));
                    
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));
                    
                    $('body').append(form);
                    form.submit();
                }
            });
        });

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