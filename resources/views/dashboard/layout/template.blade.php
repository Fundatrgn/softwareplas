@include('dashboard.layout.header')
@if (session('success'))
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
@yield('content')
@include('dashboard.layout.footer')