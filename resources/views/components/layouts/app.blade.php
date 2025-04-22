<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name') }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

@filamentStyles
{{-- @vite('resources/css/app.css')
@vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Jika menggunakan Vite -->
<!-- atau -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Jika menggunakan Mix --> --}}

<!-- Di app.blade.php -->
<link href="{{ asset('css/filament.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Tailwind harus diakhir -->
    </head>

    <body class="antialiased">
        {{ $slot }}

        @livewire('notifications')

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
