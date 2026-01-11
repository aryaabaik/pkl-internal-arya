@extends('layouts.app')

@section('title', 'Profil - ' . ($user->name ?? 'User'))

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
body{
    font-family:'Plus Jakarta Sans',sans-serif;
    background:#f8fafc;
}

/* CARD */
.card-profile{
    border-radius:22px;
    background:rgba(255,255,255,.9);
    backdrop-filter:blur(16px);
    border:1px solid #e5e7eb;
    box-shadow:0 20px 50px rgba(15,23,42,.12);
}

/* HEADER */
.profile-header{
    height:170px;
    background:linear-gradient(135deg,#667eea,#764ba2);
}

/* AVATAR */
.profile-img-wrapper{
    margin-top:-75px;
}
.profile-img-container{
    display:inline-block;
    padding:6px;
    border-radius:50%;
    background:linear-gradient(135deg,#667eea,#764ba2);
}
.profile-img{
    width:140px;
    height:140px;
    border-radius:50%;
    border:4px solid #fff;
    object-fit:cover;
}

/* NAME */
.username{
    font-weight:800;
    color:#1f2937;
}

/* BUTTON */
.btn-edit{
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:#fff;
    border-radius:999px;
    padding:10px 28px;
    font-weight:700;
}
.btn-edit:hover{opacity:.9;color:#fff}

/* STATS */
.stat-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:16px;
    padding:16px;
    text-align:center;
}
.stat-value{
    font-size:1.35rem;
    font-weight:800;
    color:#667eea;
}
.stat-label{
    font-size:.75rem;
    letter-spacing:.08em;
    color:#6b7280;
    text-transform:uppercase;
}

/* INFO */
.info-box{
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:16px;
}
.info-row{
    padding:14px 0;
    border-bottom:1px dashed #e5e7eb;
}
.info-row:last-child{border:none}
</style>

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-lg-8">

@if(isset($user))
<div class="card-profile">

    <div class="profile-header"></div>

    <div class="p-4 text-center">

        {{-- AVATAR --}}
        <div class="profile-img-wrapper mb-3">
            <div class="profile-img-container">
                <img class="profile-img"
                     src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=667eea&color=fff' }}">
            </div>
        </div>

        {{-- NAME --}}
        <h2 class="username mb-1">{{ $user->name }}</h2>
        <span class="badge rounded-pill px-3 py-2 mb-3"
              style="background:rgba(102,126,234,.1);color:#667eea;">
            <i class="bi bi-person-check me-1"></i> Member
        </span>

        {{-- EDIT --}}
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
                    <div class="stat-value">{{ $user->orders?->count() ?? 0 }}</div>
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
                        {{ $user->created_at->diffForHumans(['parts'=>1]) }}
                    </div>
                    <div class="stat-label">Bergabung</div>
                </div>
            </div>
        </div>

        {{-- INFO --}}
        <div class="info-box p-4 mt-4 text-start">
            <div class="info-row">
                <strong>Email</strong><br>
                <span class="text-muted">{{ $user->email }}</span>
            </div>
            <div class="info-row">
                <strong>Member Sejak</strong><br>
                <span class="text-muted">{{ $user->created_at->format('d M Y') }}</span>
            </div>

            @if($user->is_admin)
            <div class="info-row text-success fw-bold">
                Role: Administrator
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
