@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Riwayat Status Permohonan</h3>
                    <p class="text-subtitle text-muted">Kelola riwayat perubahan status permohonan surat</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Status</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- end header --}}

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- start main content --}}
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('riwayat.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i> Tambah Riwayat
                    </a>
                </div>
                <div class="card-body">
                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Permohonan</th>
                                <th>Status</th>
                                <th>Petugas</th>
                                <th>Waktu</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->permohonan->nomor_permohonan ?? '-' }}</td>
                                    <td>
                                        @if ($item->status == 'Diajukan')
                                            <span class="badge bg-warning">Diajukan</span>
                                        @elseif($item->status == 'Diproses')
                                            <span class="badge bg-info">Diproses</span>
                                        @elseif($item->status == 'Selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($item->status == 'Ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->petugas->nama ?? 'System' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($item->keterangan)
                                            <span class="text-muted small">{{ Str::limit($item->keterangan, 50) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex" style="gap: 8px;">
                                            <a href="{{ route('riwayat.edit', $item->riwayat_id) }}"
                                                class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 32px; padding: 0;">
                                                <i data-feather="edit" style="width: 16px; height: 16px;"></i>
                                                <span class="ms-1" style="font-size: 12px;">Edit</span>
                                            </a>
                                            <form action="{{ route('riwayat.destroy', $item->riwayat_id) }}" method="POST"
                                                class="d-inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 32px; padding: 0;"
                                                    onclick="return confirm('Yakin ingin menghapus riwayat ini?')">
                                                    <i data-feather="trash" style="width: 16px; height: 16px;"></i>
                                                    <span class="ms-1" style="font-size: 12px;">Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    {{-- end main content --}}
@endsection

