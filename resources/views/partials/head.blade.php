<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'AGMA v2') : config('app.name', 'AGMA v2') }}
</title>
<link rel="icon" href="{{ asset('images/favicon_io/ileco32x32.png') }}" sizes="any">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

@fonts

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
