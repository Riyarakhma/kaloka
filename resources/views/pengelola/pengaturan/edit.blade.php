@extends('layouts.admin')

@section('judul', 'Pengaturan Situs')

@section('konten')
    <h1 class="h4 mb-3">Pengaturan Situs</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pengelola.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Situs <span class="text-danger">*</span></label>
                    <input type="text" name="nama_situs" class="form-control" value="{{ old('nama_situs', $nilai['nama_situs']) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo Situs</label>
                    @if (!empty($situs['logo']))
                        <div class="mb-2"><img src="{{ $situs['logo'] }}" alt="Logo" style="height:48px;background:#fff;border-radius:.3rem;padding:2px;"></div>
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <div class="form-text">Format PNG/JPG/WebP/SVG, maks 2 MB. Tampil di navbar & portal. Kosongkan bila tak diubah.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kontak Desa</label>
                    <textarea name="kontak" class="form-control" rows="2">{{ old('kontak', $nilai['kontak']) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teks Sambutan Beranda</label>
                    <textarea name="teks_sambutan" class="form-control" rows="3">{{ old('teks_sambutan', $nilai['teks_sambutan']) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL OPAC SLiMS (katalog)</label>
                    <input type="url" name="url_opac_slims" class="form-control"
                           value="{{ old('url_opac_slims', $nilai['url_opac_slims']) }}"
                           placeholder="http://namadesa.web.id/katalog">
                    <div class="form-text">
                        Alamat OPAC SLiMS yang akan ditautkan dari portal & dashboard. Jangan di-hardcode — atur di sini.
                    </div>
                </div>

                <button class="btn btn-kaloka"><i class="bi bi-save me-1"></i>Simpan Pengaturan</button>
            </form>
        </div>
    </div>
@endsection
