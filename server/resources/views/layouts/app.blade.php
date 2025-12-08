<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Qatarbuyshipfurniture' }}</title>

    <!-- Load CSS from public -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Load JS from public -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bundle.js') }}" defer></script>
</head>

<body x-data="{ page: 'home', 'darkMode': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }"
      x-init="
            darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))
      "
      :class="{'b eh': darkMode === true}">

    {{-- Header --}}
    @include('layouts.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <button class="xc wf xf ie ld vg sr gh tr g sa ta _a"
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        @scroll.window="scrollTop = (window.pageYOffset > 50) ? true : false"
        :class="{ 'uc' : scrollTop }">

        <svg class="uh se qd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3
                     86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
        </svg>
    </button>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>
</html>
