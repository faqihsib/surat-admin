@extends('layouts.admin.app')

@section('content')
    {{-- start main content --}}
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Warga</h3>
                    <p class="text-subtitle text-muted">Kelola data warga desa</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Warga</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Pesan Sukses/Error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary">
                        <i data-feather="plus"></i> Tambah Warga
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12 d-flex justify-content-end">
                            {{-- Form Filter --}}
                            <form method="GET" action="{{ route('warga.index') }}" class="form-inline">
                                <div class="input-group">
                                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                        <option value="">Jenis Kelamin</option>
                                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @if(request('jenis_kelamin'))
                                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">Reset</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class='table table-striped' id="table1">
                        <thead>
                            <tr>
                                <th>No. KTP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>Pekerjaan</th>
                                <th>Agama</th>
                                <th>Telepon</th>
                                <th width="130px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataWarga as $item)
                                <tr>
                                    <td>{{ $item->no_ktp }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->pekerjaan }}</td>
                                    <td>{{ $item->agama }}</td>
                                    <td>{{ $item->telp }}</td>
                                    <td>
                                        <div class="d-flex" style="gap: 8px;">
                                            <a href="{{ route('warga.edit', $item->warga_id) }}"
                                               class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
                                               style="width: 60px; height: 32px; padding: 0;">
                                                <i data-feather="edit" style="width: 16px; height: 16px;"></i>
                                                <span class="ms-1" style="font-size: 12px;">Edit</span>
                                            </a>
                                            <form action="{{ route('warga.destroy', $item->warga_id) }}"
                                                  method="POST"
                                                  class="d-inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                                        style="width: 60px; height: 32px; padding: 0;"
                                                        onclick="return confirm('Yakin ingin menghapus?')">
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
                    <div class="mt-3">
                        {{ $dataWarga->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- end main content --}}
@endsection

<style>
.d-flex {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
}

.d-flex .btn-sm {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
}

.d-flex form {
    margin: 0;
    display: flex;
}
</style>
