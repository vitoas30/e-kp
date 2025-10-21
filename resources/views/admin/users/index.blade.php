@extends('layouts.admin')

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
                            <input type="text" id="searchUsers" class="form-control form-control-solid w-250px ps-13" placeholder="Search user" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" id="exportButton" class="btn btn-light-primary">
                            <i class="ki-duotone ki-exit-up fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Export
                        </button>
                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table table-row-dashed table-row-gray-400 gs-5 gy-5 gx-5 nowrap table-hover align-middle" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">User</th>
                                <th class="min-w-125px">Role</th>
                                <th class="min-w-125px">Joined Date</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($users as $user)
                            <tr>
                                <td class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span>{{ $user->roles->pluck('name')->join(', ') }}</span>
                                </td>
                                <td>
                                    <span>{{ $user->created_at->format('d M Y, h:i a') }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-info btn-sm" data-kt-menu-trigger="click" title="Setting" data-kt-menu-placement="bottom-end">
                                        <i class="ki-solid ki-gear fs-5 m-0"></i>
                                        <i class="ki-duotone ki-down fs-5 m-0"></i>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        {{-- <div class="menu-item px-3">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="menu-link px-3"><i class="ki-solid ki-pencil fs-2 me-1"></i> Edit</a>
                                        </div> --}}
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="menu-link px-3"><i class="ki-solid ki-eye fs-2 me-1"></i> View</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0);" class="menu-link px-3 deleteAlert" title="Delete" data-url="{{route('admin.users.destroy', $user->id)}}">
                                                <i class="ki-solid ki-trash fs-2 me-1"></i> Delete
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
@endsection

@push('scripts')
<script>
    let dataTable = null;
    const hasData = {{ $users->count() > 0 ? 'true' : 'false' }};

    function initDataTable() {
        const tableElement = $('#kt_table_users');
        if (!tableElement.length) return;
        
        // Destroy existing instance if exists
        if ($.fn.DataTable.isDataTable('#kt_table_users')) {
            $('#kt_table_users').DataTable().destroy();
        }
        
        // Only initialize DataTable if there's data
        if (hasData) {
            dataTable = tableElement.DataTable({
                responsive: true,
                searching: true,
                info: true,
                order: [[2, 'desc']], // Sort by joined date descending
                pageLength: 10,
                lengthChange: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                language: {
                    emptyTable: "No users available",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    infoEmpty: "Showing 0 to 0 of 0 users",
                    infoFiltered: "(filtered from _MAX_ total users)",
                    lengthMenu: "Show _MENU_",
                    zeroRecords: "No matching users found",
                    paginate: {
                        first: '<i class="ki-duotone ki-double-left fs-2"><span class="path1"></span><span class="path2"></span></i>',
                        last: '<i class="ki-duotone ki-double-right fs-2"><span class="path1"></span><span class="path2"></span></i>',
                        next: '<i class="ki-duotone ki-right fs-2"></i>',
                        previous: '<i class="ki-duotone ki-left fs-2"></i>'
                    }
                },
                columnDefs: [
                    { targets: 3, orderable: false, searchable: false }, // Actions column
                    { targets: 0, orderable: true, searchable: true },   // User column
                    { targets: 1, orderable: true, searchable: true },   // Role column
                    { targets: 2, orderable: true, searchable: true }    // Date column
                ],
                drawCallback: function() {
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                }
            });

            // Custom Search Handler
            $('#searchUsers').on('keyup', function() {
                dataTable.search(this.value).draw();
            });

            // Export Button Handler
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
                        // Extract user name and email
                        const userCell = $(row[0]);
                        const name = userCell.find('a').text().trim();
                        const email = userCell.find('span').last().text().trim();
                        
                        // Extract role
                        const role = $(row[1]).find('span').text().trim() || '-';
                        
                        // Extract date
                        const joinedDate = $(row[2]).find('span').text().trim();
                        
                        tableRows += '<tr>' +
                            '<td>' + escapeHtml(name) + '</td>' +
                            '<td>' + escapeHtml(email) + '</td>' +
                            '<td>' + escapeHtml(role) + '</td>' +
                            '<td>' + escapeHtml(joinedDate) + '</td>' +
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
                        '</style>' +
                        '</head>' +
                        '<body>' +
                        '<table>' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Name</th>' +
                        '<th>Email</th>' +
                        '<th>Role</th>' +
                        '<th>Joined Date</th>' +
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
                    const filename = 'users-' + new Date().toISOString().split('T')[0] + '.xls';
                    
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
                            text: 'User data has been exported to Excel',
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

            // Enable search and export
            $('#searchUsers').prop('disabled', false);
            $('#exportButton').prop('disabled', false);
        } else {
            // Show empty state if no data
            tableElement.find('tbody').html(`
                <tr>
                    <td colspan="4" class="text-center text-muted py-5">
                        <div class="d-flex flex-column align-items-center">
                            <i class="ki-outline ki-information-5 fs-3x mb-3"></i>
                            <span class="fw-semibold fs-5">No users found.</span>
                            <span class="text-muted fs-7">Start by adding a new user</span>
                        </div>
                    </td>
                </tr>
            `);

            // Disable search and export when empty
            $('#searchUsers').prop('disabled', true);
            $('#exportButton').prop('disabled', true);
        }
    }

    // Initialize when DOM is ready
    $(document).ready(function() {
        initDataTable();

        // Delete Handler with AJAX
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
                    // Create a form and submit it
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
                        'value': 'GET'
                    }));
                    
                    $('body').append(form);
                    form.submit();
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