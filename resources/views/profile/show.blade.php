@extends('layouts.app')

@section('title', 'StudiaShop - Profil ' . ($user->name ?? 'User'))

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ===== GLASS CARD ===== */
    .card-profile {
        border-radius: 24px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(18px);
        box-shadow: 0 30px 80px rgba(0,0,0,.15);
        transition: .4s ease;
    }

    .card-profile:hover {
        transform: translateY(-6px);
    }

    /* ===== HEADER ===== */
    .profile-header {
        height: 190px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        position: relative;
    }

    .profile-header::after {
        content: "";
        position: absolute;
        inset: 0;
        background: url("https://www.transparenttextures.com/patterns/cubes.png");
        opacity: .08;
    }

    /* ===== AVATAR ===== */
    .profile-img-wrapper {
        margin-top: -85px;
        position: relative;
        z-index: 2;
    }

    .profile-img-container {
        padding: 7px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        box-shadow: 0 15px 40px rgba(0,0,0,.25);
        position: relative;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
    }

    /* ONLINE DOT */
    .status-dot {
        position: absolute;
        bottom: 8px;
        right: 8px;
        width: 16px;
        height: 16px;
        background: #2ecc71;
        border: 3px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 6px rgba(46,204,113,.25);
    }

    /* ===== NAME ===== */
    .username {
        font-weight: 800;
        letter-spacing: -.5px;
        color: #2d3436;
    }

    /* ===== BUTTON ===== */
    .btn-edit {
        padding: 12px 36px;
        border-radius: 50px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        font-weight: 700;
        color: #fff;
        transition: .3s;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(118,75,162,.4);
    }

    /* ===== STATS ===== */
    .stat-card {
        background: #fff;
        border-radius: 18px;
        padding: 18px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
        transition: .3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-value {
        font-size: 1.4rem;
        font-weight: 800;
        color: #667eea;
    }

    .stat-label {
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #95a5a6;
        font-weight: 700;
    }

    /* ===== INFO ROW ===== */
    .info-row {
        padding: 14px 0;
        border-bottom: 1px dashed #eaeaea;
    }

    .info-row:last-child {
        border-bottom: none;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

        @if(isset($user))
        <div class="card card-profile">

            <div class="profile-header"></div>

            <div class="card-body pt-0 p-4 text-center">

                {{-- AVATAR --}}
                <div class="profile-img-wrapper mb-3">
                    <div class="profile-img-container">
                        @if($user->avatar)
                            <img src="{{ $user->avatar_url }}" class="profile-img">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200&background=667eea&color=fff" class="profile-img">
                        @endif
                        <span class="status-dot"></span>
                    </div>
                </div>

                {{-- NAME --}}
                <h2 class="username mb-1">{{ $user->name }}</h2>
                <span class="badge rounded-pill px-3 py-2 mb-3"
                    style="background:rgba(102,126,234,.1);color:#667eea;">
                    <i class="bi bi-patch-check-fill me-1"></i> Premium Member
                </span>

                {{-- BUTTON --}}
                @auth
                    @if(auth()->id() === $user->id)
                        <div class="mt-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-edit">
                                <i class="bi bi-pencil-square me-2"></i>Edit Profil
                            </a>
                        </div>
                    @endif
                @endauth

                {{-- STATS --}}
                <div class="row g-3 mt-4">
                    <div class="col-4">
                        <div class="stat-card">
                            <div class="stat-value">{{ optional($user->orders)->count() ?? 0 }}</div>
                            <div class="stat-label">Orders</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-card">
                            <div class="stat-value">{{ $user->wishlists?->count() ?? 0 }}</div>
                            <div class="stat-label">Wishlist</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-card">
                            <div class="stat-value">
                                {{ $user->created_at->diffInDays(now())  }}
                            </div>
                            <div class="stat-label">Days</div>
                        </div>
                    </div>
                </div>

                {{-- INFO --}}
                <div class="bg-light rounded-4 p-4 mt-4 text-start">
                    <div class="info-row">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="info-row">
                        <strong>Member Sejak:</strong>
                        {{ $user->created_at->format('d M Y') }}
                    </div>

                    @if($user->is_admin)
                    <div class="info-row text-success">
                        <strong>Role:</strong> Administrator
                    </div>
                    @endif
                </div>

            </div>
        </div>
        @endif

        </div>
    </div>
</div>
@endsection
