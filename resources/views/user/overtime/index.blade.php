@extends('layouts.user')

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Pengajuan Lembur (Overtime)</h3>
        </div>
    </div>
    
    <div class="card-body p-9">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Pengajuan -->
        <form action="{{ route('user.overtime.store') }}" method="POST" class="form mb-10">
            @csrf
            <div class="row mb-6">
                <div class="col-lg-6 mb-4">
                     <label class="required form-label fw-bold fs-6">Tanggal</label>
                     <input type="date" name="date" class="form-control form-control-lg form-control-solid" value="{{ date('Y-m-d') }}" required />
                </div>
                <div class="col-lg-6 mb-4">
                     <label class="required form-label fw-bold fs-6">Proyek</label>
                     <select name="project_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Proyek" required>
                        <option></option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                     </select>
                </div>
            </div>
            
             <div class="row mb-6">
                <div class="col-lg-6 mb-4">
                     <label class="required form-label fw-bold fs-6">Jam Mulai</label>
                     <input type="time" name="start_time" class="form-control form-control-lg form-control-solid" required />
                </div>
                <div class="col-lg-6 mb-4">
                     <label class="required form-label fw-bold fs-6">Jam Selesai</label>
                     <input type="time" name="end_time" class="form-control form-control-lg form-control-solid" required />
                </div>
            </div>

            <div class="row mb-6">
                 <div class="col-lg-12 mb-4">
                     <label class="form-label fw-bold fs-6">Task (Opsional)</label>
                     <select name="task_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih Task Terkait">
                        <option></option>
                        @foreach($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->name }}</option>
                        @endforeach
                     </select>
                </div>
            </div>
            
            <div class="row mb-6">
                <div class="col-lg-12">
                    <label class="required form-label fw-bold fs-6">Alasan Lembur / Deskripsi Pekerjaan</label>
                    <textarea name="reason" class="form-control form-control-lg form-control-solid" rows="3" required></textarea>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Batal</button>
                <button type="submit" class="btn btn-primary">Ajukan Lembur</button>
            </div>
        </form>

        <div class="separator separator-dashed my-6"></div>

        <!-- History -->
        <h3 class="fw-bold mb-5">Riwayat Pengajuan Lembur</h3>
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-100px">Tanggal</th>
                        <th class="min-w-100px">Proyek/Task</th>
                        <th class="min-w-100px">Waktu</th>
                        <th class="min-w-150px">Alasan</th>
                        <th class="min-w-100px">Status</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @foreach($overtimes as $overtime)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($overtime->date)->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-gray-800 fw-bold">{{ $overtime->project->name ?? '-' }}</span>
                                    <span class="text-muted fs-7">{{ $overtime->task->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($overtime->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($overtime->end_time)->format('H:i') }}
                                <br>
                                <span class="text-muted fs-8">
                                    @php
                                        $start = \Carbon\Carbon::parse($overtime->start_time);
                                        $end = \Carbon\Carbon::parse($overtime->end_time);
                                        $diff = $start->diff($end);
                                        echo $diff->h . ' Jam ' . $diff->i . ' Menit';
                                    @endphp
                                </span>
                            </td>
                            <td>{{ $overtime->reason }}</td>
                            <td>
                                @php
                                    $statusColor = match($overtime->status) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'warning'
                                    };
                                @endphp
                                <span class="badge badge-light-{{ $statusColor }}">{{ ucfirst($overtime->status) }}</span>
                            </td>
                            <td class="text-end">
                                @if($overtime->status == 'pending')
                                    <form action="{{ route('user.overtime.destroy', $overtime->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengajuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                            <i class="ki-duotone ki-trash fs-2">
                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                            </i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if($overtimes->isEmpty())
                        <tr><td colspan="6" class="text-center">Belum ada data lembur</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $overtimes->links() }}
        </div>
    </div>
</div>
@endsection
