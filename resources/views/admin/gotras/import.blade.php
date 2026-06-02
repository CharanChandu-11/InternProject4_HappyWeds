@extends('layouts.admin')
@section('title', 'Import Areas - HappilyWeds')

@push('page-styles')
<style>
    .premium-card { background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); }
    .file-drop-zone {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        background: #f8fafc;
        transition: all 0.2s;
    }
    .file-drop-zone:hover { border-color: #e75480; background: #fff; }
</style>
@endpush

@section('content')
<div class="bg-glow-orb orb-1"></div>
<div class="bg-glow-orb orb-2"></div>

<svg width="0" height="0" class="position-absolute">
    <defs>
        <linearGradient id="signatureGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#0a0a0a" />
            <stop offset="100%" stop-color="#e75480" />
        </linearGradient>
    </defs>
</svg>

<div class="container py-5 page-spacing font-sans" style="max-width: 800px;">
    <div class="premium-card p-5 text-center animate-card">
        <i class="bi bi-file-earmark-excel fs-1 text-gradient mb-3"></i>
        <h3 class="font-serif fw-bold">Import Gotras from Excel</h3>
        <p class="text-muted mb-4">Upload .xlsx, .xls, or .csv file with columns:<br> 
        <strong>gotra</strong> (first row headings)</p>

        <form action="{{ route('admin.gotras.import') }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            <div class="file-drop-zone p-5 mb-4">
                <input type="file" name="file" class="form-control premium-input" accept=".xlsx,.xls,.csv" required>
                <small class="text-muted mt-2 d-block">Maximum size: 2MB</small>
            </div>
            @error('file') <div class="text-danger mb-3">{{ $message }}</div> @enderror
            <div class="d-flex gap-3 justify-content-center">
                <button type="submit" class="btn-glow px-5"><i class="bi bi-upload me-2"></i>Import</button>
                <a href="{{ route('admin.gotras.index') }}" class="btn btn-light px-4">Cancel</a>
            </div>
        </form>
        <hr class="my-5">
        <div class="text-start">
            <h6>📥 Sample Excel structure:</h6>
            <pre class="bg-light p-3 rounded" style="font-size: 0.8rem;">gotra</pre>
            <a href="{{ route('admin.gotras.export') }}" class="text-decoration-none">⬇ Download sample template</a>
        </div>
    </div>
</div>
@endsection