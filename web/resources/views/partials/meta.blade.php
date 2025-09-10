<!-- resources/views/client/layouts/meta.blade.php -->
<title>{{ $seo['title'] ?? 'Nama Situs' }}</title>
<meta name="description" content="{{ $seo['description'] ?? '' }}">

<!-- Open Graph -->
<meta property="og:title" content="{{ $seo['title'] ?? 'Nama Situs' }}">
<meta property="og:description" content="{{ $seo['description'] ?? '' }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $seo['image'] ?? asset('og-image.png') }}">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seo['title'] ?? 'Nama Situs' }}">
<meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
<meta name="twitter:image" content="{{ $seo['image'] ?? asset('og-image.png') }}">
