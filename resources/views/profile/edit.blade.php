@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f5f7fb;
    }

    /* ===== PAGE ===== */
    .settings-wrapper {
        max-width: 1200px;
        margin: auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -.5px;
        color: #2d3436;
    }

    .page-desc {
        color: #636e72;
        margin-top: 4px;
    }

    /* ===== SECTION CARD ===== */
    .settings-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 28px;
        border: 1px solid #eef1f7;
        box-shadow: 0 20px 40px rgba(0,0,0,.08);
        transition: .25s ease;
    }

    .settings-card:hover {
        transform: translateY(-3px);
    }

    .settings-title {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 6px;
        color: #2d3436;
    }

    .settings-subtitle {
        font-size: .9rem;
        color: #8395a7;
        margin-bottom: 20px;
    }

    /* ===== FORM INPUT ===== */
    input, select, textarea {
        border-radius: 14px !important;
        padding: 12px 16px !important;
        border: 1px solid #dde3f0 !important;
        font-weight: 500;
        background: #fff;
    }

    input:focus, textarea:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102,126,234,.18) !important;
    }

    /* ===== BUTTON ===== */
    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 50px;
        padding: 12px 34px;
        font-weight: 700;
        box-shadow: 0 14px 30px rgba(118,75,162,.35);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 45px rgba(118,75,162,.45);
    }

    /* ===== DANGER ===== */
    .danger {
        border: 1px solid rgba(231,76,60,.25);
        background: #fff5f5;
    }

    .danger .settings-title {
        color: #e74c3c;
    }

</style>

<div class="container-fluid py-5">
    <div class="settings-wrapper">

        {{-- HEADER --}}
        <div class="page-header">
            <div>
                <div class="page-title">Pengaturan Akun</div>
                <div class="page-desc">Kelola informasi, keamanan, dan preferensi akun kamu</div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success rounded-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- GRID --}}
        <div class="row g-4">

            {{-- AVATAR --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Foto Profil</div>
                    <div class="settings-subtitle">Avatar akan ditampilkan di seluruh aplikasi</div>
                    @include('profile.partials.update-avatar-form')
                </div>
            </div>

            {{-- PROFILE INFO --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Informasi Akun</div>
                    <div class="settings-subtitle">Nama, email, dan data dasar akun</div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Keamanan</div>
                    <div class="settings-subtitle">Ubah password akun kamu</div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- CONNECTED --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Akun Terhubung</div>
                    <div class="settings-subtitle">Login menggunakan layanan pihak ketiga</div>
                    @include('profile.partials.connected-accounts')
                </div>
            </div>

            {{-- DELETE --}}
            <div class="col-12">
                <div class="settings-card danger">
                    <div class="settings-title">Zona Berbahaya</div>
                    <div class="settings-subtitle">Tindakan ini tidak bisa dibatalkan</div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
