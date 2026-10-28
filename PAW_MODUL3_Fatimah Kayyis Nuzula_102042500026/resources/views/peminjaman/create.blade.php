@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Transaksi Peminjaman Buku</h3>
                <p class="text-muted small mb-0">Catat peminjaman buku oleh anggota perpustakaan.</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                   {{-- Dropdown Select Anggota --}}
    <div class="mb-3">
        <label for="anggota_id" class="form-label">Pilih Anggota</label>
        <select class="form-select @error('anggota_id') is-invalid @enderror" id="anggota_id" name="anggota_id">
            <option value="" selected disabled>-- Pilih Anggota Peminjam --</option>
            @foreach ($anggota as $item)
                <option value="{{ $item->id }}" {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama }} ({{ $item->email }})
                </option>
            @endforeach
        </select>
        @error('anggota_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Dropdown Select Buku --}}
    <div class="mb-3">
        <label for="buku_id" class="form-label">Pilih Buku</label>
        <select class="form-select @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id">
            <option value="" selected disabled>-- Pilih Buku yang Dipinjam --</option>
            @foreach ($buku as $item)
                <option value="{{ $item->id }}" {{ old('buku_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->judul }} (Stok: {{ $item->stok }})
                </option>
            @endforeach
        </select>
        <div class="form-text text-muted">Hanya buku dengan stok &gt; 0 yang muncul dalam pilihan. Stok akan otomatis berkurang 1.</div>
        @error('buku_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Input Field Tanggal Pinjam --}}
    <div class="mb-3">
        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
        <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
        @error('tanggal_pinjam')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Tombol Submit --}}
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
    </div>
</form>
            </div>
        </div>
    </div>
</div>
@endsection
