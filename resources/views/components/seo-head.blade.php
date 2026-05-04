@inject('seoSettings', 'App\Settings\SeoSettings')

{!! SEO::generate() !!}
{!! JsonLd::generate() !!}

{{-- hreflangs: single-language site, emit en + x-default --}}
@php $canonical = SEOMeta::getCanonical() ?: url()->current(); @endphp
<link rel="alternate" hreflang="en" href="{{ $canonical }}" />
<link rel="alternate" hreflang="x-default" href="{{ $canonical }}" />

@if($seoSettings->google_site_verification)
<meta name="google-site-verification" content="{{ $seoSettings->google_site_verification }}" />
@endif
