<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include('layouts.header')
    <div class="body flex-grow-1 px-3">
        <div class="row">
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
</div>