<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @if(file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body { margin:0; font-family:Figtree, Arial, sans-serif; background:#f3f4f6; color:#111827; }
                a { color:inherit; }
                button, input, select, textarea { font:inherit; }
                .min-h-screen { min-height:100vh; }
                .bg-gray-100 { background:#f3f4f6; }
                .bg-white { background:#fff; }
                .border-b { border-bottom:1px solid #e5e7eb; }
                .max-w-7xl { max-width:80rem; }
                .mx-auto { margin-left:auto; margin-right:auto; }
                .px-4, .sm\:px-6, .lg\:px-8 { padding-left:1rem; padding-right:1rem; }
                .py-6, .py-12 { padding-top:1.5rem; padding-bottom:1.5rem; }
                .p-4, .p-6, .sm\:p-8 { padding:1rem; }
                .mt-3 { margin-top:.75rem; }
                .space-y-6 > * + * { margin-top:1.5rem; }
                .shadow, .shadow-sm { box-shadow:0 1px 3px rgba(0,0,0,.1); }
                .rounded-md, .sm\:rounded-lg { border-radius:.5rem; }
                .flex { display:flex; }
                .hidden { display:none; }
                .justify-between { justify-content:space-between; }
                .items-center { align-items:center; }
                .h-16 { height:4rem; }
                .font-semibold { font-weight:600; }
                .text-xl { font-size:1.25rem; }
                .text-gray-800 { color:#1f2937; }
                .text-gray-900 { color:#111827; }
                .text-gray-500 { color:#6b7280; }
                .leading-tight { line-height:1.25; }
                .max-w-xl { max-width:36rem; }
                .overflow-hidden { overflow:hidden; }
                .block { display:block; }
                .inline-flex { display:inline-flex; }
                .w-full { width:100%; }
                .mt-1 { margin-top:.25rem; }
                .mt-2 { margin-top:.5rem; }
                .mt-4 { margin-top:1rem; }
                .gap-4 { gap:1rem; }
                input, textarea, select { border:1px solid #d1d5db; border-radius:.375rem; padding:.5rem .75rem; }
            </style>
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
