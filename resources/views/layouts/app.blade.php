<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
        }

        .scroll-y {
            overflow-y: auto;
            max-height: 400px;
        }

        .produk-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #e5e7eb;
        }

        .produk-card:hover {
            transform: scale(1.02);
            box-shadow: 0 2px 8px rgba(0, 180, 178, 0.2);
        }

        .btn-primary {
            background-color: #0BB4B2;
            color: white;
        }

        .btn-primary:hover {
            background-color: #089f9d;
        }

        .highlight {
            background-color: #e0f7f6;
            color: #0BB4B2;
            font-weight: bold;
        }

        .kategori-button {
            border: 1px solid #0BB4B2;
            color: #0BB4B2;
        }

        .kategori-button:hover {
            background-color: #e0f7f6;
        }

        .active-kategori {
            background-color: #0BB4B2;
            color: white;
        }

        .dropdown-button:hover {
            color: #0BB4B2;
        }
    </style>

    <!-- Optional Custom CSS -->
    @stack('styles')
</head>
<body class="bg-gray-100">

    @yield('content')

    <!-- Optional Custom JS -->
    @stack('scripts')

</body>
</html>
