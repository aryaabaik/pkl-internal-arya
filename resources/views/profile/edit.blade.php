@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f6f7fb;
    color: #1f2937;
}

/* WRAPPER */
.settings-wrapper {
    max-width: 1100px;
    margin: auto;
}

/* HEADER */
.page-header {
    margin-bottom: 32px;
}

.page-title {
    font-size: 1.9rem;
    font-weight: 800;
    letter-spacing: -.3px;
}

.page-desc {
    color: #6b7280;
    margin-top: 4px;
}

/* CARD */
.settings-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 26px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 8px 20px rgba(0,0,0,.06);
}

.settings-title {
    font-weight: 700;
    font-size: 1.05rem;
    margin-bottom: 4px;
}

.settings-subtitle {
    font-size: .88rem;
    color: #6b7280;
    margin-bottom: 18px;
}

/* FORM */
input, select, textarea {
    border-radius: 10px !important;
    padding: 11px 14px !important;
    border: 1px solid #d1d5db !important;
    font-weight: 500;
}

input:focus, textarea:focus {
    border-color: #6366f1 !important;
    box-shadow: 0 0 0 3px rgba(99,102,241,.18) !important;
}

/* BUTTON */
.btn-primary {
    background: #6366f1;
    border: none;
    border-radius: 10px;
    padding: 10px 26px;
    font-weight: 600;
}

.btn-primary:hover {
    background: #4f46e5;
}

/* ALERT */
.alert-success {
    border-radius: 12px;
    border: 1px solid #bbf7d0;
    background: #f0fdf4;
    color: #166534;
}

/* DANGER */
.danger {
    border: 1px solid #fecaca;
    background: #fffafa;
}

.danger .settings-title {
    color: #b91c1c;
}
</style>

<div class="container-fluid py-5">
    <div class="settings-wrapper">

        {{-- HEADER --}}
        <div class="page-header">
            <div class="page-title">Pengaturan Akun</div>
            <div class="page-desc">
                Kelola informasi pribadi, keamanan, dan koneksi akun Anda
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">

            {{-- AVATAR --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Foto Profil</div>
                    <div class="settings-subtitle">
                        Digunakan di seluruh sistem
                    </div>
                    @include('profile.partials.update-avatar-form')
                </div>
            </div>

            {{-- PROFILE INFO --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Informasi Akun</div>
                    <div class="settings-subtitle">
                        Nama, email, dan data dasar
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Keamanan</div>
                    <div class="settings-subtitle">
                        Perbarui kata sandi akun
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- CONNECTED --}}
            <div class="col-lg-6">
                <div class="settings-card h-100">
                    <div class="settings-title">Akun Terhubung</div>
                    <div class="settings-subtitle">
                        Layanan pihak ketiga
                    </div>
                    @include('profile.partials.connected-accounts')
                </div>
            </div>

            {{-- DELETE --}}
            <div class="col-12">
                <div class="settings-card danger">
                    <div class="settings-title">Zona Berbahaya</div>
                    <div class="settings-subtitle">
                        Aksi permanen & tidak dapat dibatalkan
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
