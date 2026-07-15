@php
    /** @var \App\Models\User|null $pengguna */
    $pengguna = $pengguna ?? null;
@endphp

@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $pengguna->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $pengguna->email ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Peran <span class="text-danger">*</span></label>
        <select name="role" class="form-select" required>
            <option value="pengelola" @selected(old('role', $pengguna->role ?? 'pengelola') === 'pengelola')>Pengelola</option>
            <option value="admin" @selected(old('role', $pengguna->role ?? '') === 'admin')>Administrator</option>
        </select>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <label class="form-label">Kata Sandi @if(!$pengguna)<span class="text-danger">*</span>@endif</label>
        <input type="password" name="password" class="form-control" {{ $pengguna ? '' : 'required' }}>
        @if ($pengguna)<div class="form-text">Kosongkan bila tidak ingin mengubah.</div>@endif
    </div>
    <div class="col-md-6">
        <label class="form-label">Konfirmasi Kata Sandi</label>
        <input type="password" name="password_confirmation" class="form-control" {{ $pengguna ? '' : 'required' }}>
    </div>
</div>
