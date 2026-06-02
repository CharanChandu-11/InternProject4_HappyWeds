@extends('layouts.admin')
@section('title', 'Import Subscriptions - HappilyWeds')

@push('page-styles')
<style>
    /* Your premium styles here */
    .import-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        padding: 2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .drop-zone {
        border: 2px dashed #e2e8f0;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .drop-zone:hover {
        border-color: #e75480;
        background: rgba(231, 84, 128, 0.05);
    }
    
    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-glow:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.45);
    }
    
    .animate-card {
        animation: fadeSlideUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
    }
    
    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(25px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-5 page-spacing font-sans">
    <div class="import-card animate-card">
        <div class="text-center mb-4">
            <i class="bi bi-upload fs-1 text-gradient"></i>
            <h3 class="font-serif fw-bold mt-2">Import Subscriptions</h3>
            <p class="text-muted">Upload Excel/CSV file to import subscription data</p>
        </div>
        
        <form action="{{ route('admin.subscriptions.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <div class="drop-zone" onclick="document.getElementById('fileInput').click()">
                    <i class="bi bi-file-earmark-excel fs-2 text-muted"></i>
                    <p class="mt-2 mb-0">Click to select file or drag and drop</p>
                    <small class="text-muted">Supported formats: .xlsx, .xls, .csv (Max 2MB)</small>
                    <input type="file" name="file" id="fileInput" class="d-none" accept=".xlsx,.xls,.csv" required>
                </div>
                @error('file')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2 justify-content-center">
                <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-light px-4">Cancel</a>
                <button type="submit" class="btn-glow px-4">Import</button>
            </div>
        </form>
        
        <div class="mt-4 pt-3 text-center">
            <small class="text-muted">
                <i class="bi bi-info-circle"></i>
                Required columns: user_id/email, plan_type, amount, billing_cycle
            </small>
        </div>
    </div>
</div>

<script>
    const dropZone = document.querySelector('.drop-zone');
    const fileInput = document.getElementById('fileInput');
    
    if (dropZone) {
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#e75480';
            dropZone.style.background = 'rgba(231, 84, 128, 0.05)';
        });
        
        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = '#e2e8f0';
            dropZone.style.background = 'transparent';
        });
        
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            fileInput.files = e.dataTransfer.files;
            dropZone.style.borderColor = '#e2e8f0';
        });
    }
    
    if (fileInput) {
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                dropZone.querySelector('p').innerHTML = `<i class="bi bi-check-circle-fill text-success"></i> ${fileInput.files[0].name}`;
            }
        });
    }
</script>
@endsection