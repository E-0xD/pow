<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') . ' — Your Work, Your Badge' }}</title>
    <meta name="description"
        content="Create a stunning portfolio that highlights your proof of work. {{ config('app.name') }}  helps professionals showcase projects, achievements, and experiences that attract clients, jobs, and recognition." />
    <meta name="keywords"
        content="portfolio builder, proof of work, digital portfolio, professional showcase, personal branding, creative portfolio, freelancer profile, developer portfolio, online resume" />
    <meta name="author" content="{{ config('app.name') }}" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset(config('app.favicon')) }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset(config('app.favicon')) }}" sizes="any">
    <link rel="icon" href="{{ asset(config('app.favicon')) }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:title" content="{{ $title ?? 'Showcase Your Digital Proof of Work | ' . config('app.name') }}" />
    <meta property="og:description"
        content="Turn your projects into opportunities. Build and share your digital proof of work with a portfolio that speaks for you." />
    <meta property="og:image" content="{{ asset(config('app.favicon')) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title"
        content="{{ $title ?? 'Build and Share Your Proof of Work | ' . config('app.name') }}" />
    <meta name="twitter:description"
        content={{ config('app.name') . ' helps professionals and creatives turn their skills and projects into a visual, shareable portfolio.' }} />
    <meta name="twitter:image" content="{{ asset(config('app.favicon')) }}" />

    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24
        }
    </style>

    @stack('styles')
</head>
