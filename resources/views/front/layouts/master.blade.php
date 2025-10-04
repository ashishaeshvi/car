<html lang="en" data-base-url="https://carkemaalik.com">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Car Ke Malik | Buy & Sell Cars in India | Used & New Car Marketplace</title>
  <!-- Basic SEO -->
  <meta name="csrf-token" content="">
  <meta name="site_url" content="https://carkemaalik.com" />
  <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
  <meta name="description" content="Car Ke Malik is India's trusted car marketplace to buy and sell cars online. Browse verified used cars, new cars, SUVs, and bikes. Get the best deals with fast, secure, and hassle-free transactions." />
  <meta name="keywords" content="Car Ke Malik, buy used cars India, sell cars online, car marketplace India, second hand cars, affordable cars, car dealers India, SUVs, bikes, auto classifieds, car marketplace" />
  <meta name="author" content="Car Ke Malik" />
  <meta name="MobileOptimized" content="320" />
  <meta name="HandheldFriendly" content="true" />
  <meta name="rating" content="General" />
  <meta name="distribution" content="Global" />

  <!-- Open Graph (Facebook, LinkedIn, etc.) -->
  <meta property="og:title" content="Car Ke Malik | Buy & Sell Cars in India | Used & New Car Marketplace" />
  <meta property="og:description" content="Buy and sell cars easily with Car Ke Malik. Explore used and new cars across India with secure and fast deals." />
  <meta property="og:url" content="https://carkemaalik.com" />
  <meta property="og:site_name" content="Car Ke Malik" />
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="en_IN" />
  <meta property="og:image" content="https://carkemaalik.com/modules/images/favicon/carkemaalik.png" />
  <meta property="og:image:alt" content="Car Ke Malik Marketplace - Buy & Sell Cars" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@carkemaalik" />
  <meta name="twitter:creator" content="@carkemaalik" />
  <meta name="twitter:title" content="Car Ke Malik | Buy & Sell Cars in India | Used & New Car Marketplace" />
  <meta name="twitter:description" content="India's trusted online car marketplace for buying and selling cars. Verified sellers, affordable deals, and fast process." />
  <meta name="twitter:image" content="https://carkemaalik.com/modules/images/favicon/carkemaalik.png" />

  <!-- Canonical URL -->
  <link rel="canonical" href="https://carkemaalik.com" />

  <!-- Favicons -->
  <link rel="shortcut icon" type="image/png" href="https://carkemaalik.com/modules/images/favicon/favicon-32x32.png" />
  <link rel="apple-touch-icon" sizes="57x57" href="https://carkemaalik.com/modules/images/favicon/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="https://carkemaalik.com/modules/images/favicon/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="https://carkemaalik.com/modules/images/favicon/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="https://carkemaalik.com/modules/images/favicon/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="https://carkemaalik.com/modules/images/favicon/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="https://carkemaalik.com/modules/images/favicon/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="https://carkemaalik.com/modules/images/favicon/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="https://carkemaalik.com/modules/images/favicon/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="https://carkemaalik.com/modules/images/favicon/apple-icon-180x180.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="https://carkemaalik.com/modules/images/favicon/android-icon-192x192.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="https://carkemaalik.com/modules/images/favicon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="96x96" href="https://carkemaalik.com/modules/images/favicon/favicon-96x96.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="https://carkemaalik.com/modules/images/favicon/favicon-16x16.png" />
  <link rel="manifest" href="https://carkemaalik.com/modules/images/favicon/manifest.json" />

  <!-- Microsoft -->
  <meta name="msapplication-TileColor" content="#1d9bf0" />
  <meta name="msapplication-TileImage" content="https://carkemaalik.com/modules/images/favicon/ms-icon-144x144.png" />
  <meta name="theme-color" content="#ffffff" />

  <!-- Structured Data (Schema.org JSON-LD for SEO) -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Car Ke Malik",
      "url": "https://carkemaalik.com",
      "logo": "https://carkemaalik.com/modules/images/favicon/carkemaalik.png",
      "sameAs": [
        "https://www.facebook.com/carkemaalik",
        "https://twitter.com/carkemaalik",
        "https://www.instagram.com/carkemaalik"
      ],
      "description": "Car Ke Malik is India's trusted marketplace to buy cars online.",
      "founder": "Car Ke Malik Team",
      "foundingDate": "2025",
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "IN"
      }
    }
  </script>

  @if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  @endif
  <title>@yield('title')</title>
  @include('front.layouts.head')
</head>

<body onload="myFunction()">
  <main id="main">
    <div id="loader"></div>
    @include('front.layouts.topbar')
    @yield('maincontent')
    @include('front.layouts.footer')
  </main>
  @include('front.layouts.scripts')
  @yield('scripts')
  @include('front.modals.login')
  @include('front.modals.city')

<script>
    var reSendOtp = "{{ route('frontend.resend.otp') }}";
    var csrfToken = "{{ csrf_token() }}";
</script>
</body>

</html>