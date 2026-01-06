<!-- Basic Meta Information -->

<title>{{ $portfolio->meta_title ?? config('app.name') }}</title>

<meta name="description" content="{{ $portfolio->meta_description ?? config('app.desc') }}">
<meta name="author" content="{{ $portfolio->about->name ?? config('app.name') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicon -->

<link rel="icon" type="image/png"
    href="{{ $portfolio->favicon ? Storage::url($portfolio->favicon) : asset(config('app.favicon')) }}">

<!--Open Graph / Facebook / LinkedIn -->

<meta property="og:title" content="{{ $portfolio->title ?? config('app.name') }}">
<meta property="og:description" content="{{ $portfolio->meta_description ?? config('app.desc') }}">
<meta property="og:image"
    content="{{ $portfolio->favicon ? Storage::url($portfolio->favicon) : asset(config('app.favicon')) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

<!-- Twitter Card -->

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $portfolio->title ?? config('app.name') }}">
<meta name="twitter:description" content="{{ $portfolio->meta_description ?? config('app.desc') }}">
<meta name="twitter:image"
    content="{{ $portfolio->favicon ? Storage::url($portfolio->favicon) : asset(config('app.logo')) }}">
