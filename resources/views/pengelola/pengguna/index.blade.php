@extends('layouts.admin')

@section('judul', 'Manajemen Pengguna')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Manajemen Pengguna</h1>
        <a href="{{ route('pengelola.pengguna.create') }}" class="btn btn-kaloka btn-sm">
            <i class="bi bi-person-plus me-1"></i>Tambah Pengguna
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr><th>Nama</th><th>Email</th><th>Peran</th><th class="text-end">Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach ($pengguna as $u)
                        <tr>
                            <td>{{ $u->name }} @if($u->id === auth()->id())<span class="badge bg-light text-dark border">Anda</span>@endif</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span class="badge bg-{{ $u->isAdmin() ? 'success' : 'secondary' }}">{{ $u->labelPeran() }}</span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('pengelola.pengguna.edit', $u) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                @if ($u->id !== auth()->id())
                                    <form action="{{ route('pengelola.pengguna.destroy', $u) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $pengguna->links() }}</div>
@endsection
