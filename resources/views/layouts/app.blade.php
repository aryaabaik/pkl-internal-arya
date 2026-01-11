{{-- ================================================
     FILE: resources/views/layouts/app.blade.php
     FUNGSI: Master layout halaman publik (Tailwind)
     UPGRADE: Visual polish, clarity, industry-ready
     ================================================ --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'Toko Online') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'Toko online terpercaya dengan produk berkualitas')">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        /* ================= BACKGROUND ================= */
        .bg-school-hub {
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, 0.342),
                    rgba(255, 255, 255, 0.384)
                ),
                url('{{ asset("images/studia.png") }}');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* ================= CONTENT WRAPPER ================= */
        .content-overlay {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(6px);
            border-radius: 1.25rem;
            box-shadow:
                0 10px 25px -5px rgba(0, 0, 0, 0.08),
                0 4px 10px -4px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body class="font-inter bg-school-hub text-gray-800 min-h-screen antialiased">

    {{-- =============================
         NAVBAR
         ============================= --}}
    <div class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-gray-200/60">
        @include('profile.partials.nav')
    </div>

    {{-- =============================
         FLASH MESSAGE
         ============================= --}}
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @include('profile.partials.flash-messages')
    </div>

    {{-- =============================
         MAIN CONTENT
         ============================= --}}
    <main class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="content-overlay p-6 md:p-8">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- =============================
         FOOTER
         ============================= --}}
    @include('profile.partials.footer')

    {{-- =============================
         SCRIPTS
         ============================= --}}
    @stack('scripts')

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 700,
            easing: 'ease-out-cubic'
        });
    </script>

    {{-- Wishlist Button Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.wishlist-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const productId = this.dataset.productId;
                    const icon = this.querySelector('i');

                    fetch(`/wishlist/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.added) {
                            icon.classList.replace('bi-heart', 'bi-heart-fill');
                            icon.classList.add('text-red-500');
                        } else {
                            icon.classList.replace('bi-heart-fill', 'bi-heart');
                            icon.classList.remove('text-red-500');
                        }
                    });
                });
            });
        });
    </script>

    <x-loader />
</body>
</html>
