<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIKEMA</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #1C0105 0%, #2A050A 50%, #1A253A 100%); 
                color: #E0E7ED;
                font-family: 'Poppins', 'Inter', sans-serif;
            }

            .bg-panel-dark {
                background-color: #1A1E24 !important;
            }

            /* Header halaman konten */
            header.bg-white {
                background-color: rgba(30, 40, 55, 0.85) !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }
