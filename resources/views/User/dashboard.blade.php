<!DOCTYPE html>
<html lang="en">
    @section('title', 'User Dashboard')
    @include('partials.header')

    <body class="sb-nav-fixed">
        @include('partials.navbar')
        <div id="layoutSidenav">
            @include('partials.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">{{ now()->hour < 12 ? 'Good morning' : (now()->hour < 18 ? 'Good afternoon' : 'Good evening') }}, {{ auth()->user()->full_name }}</h1>
                        <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">Welcome to your dashboard</li></ol>
                        <div class="card border-primary mb-4">
                            <div class="card-header">
                                <i class="fas fa-user me-1"></i> Account Overview
                            </div>
                            <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                                <div>
                                    <h2 class="h5 mb-1">{{ auth()->user()->full_name }}</h2>
                                    <div class="text-muted">{{ '@'.auth()->user()->username }}</div>
                                </div>
                                <a class="btn btn-outline-primary" href="{{ route('profile.show') }}">
                                    <i class="fas fa-id-card me-1"></i> View My Profile
                                </a>
                            </div>
                        </div>
                        <div class="card mb-4"><div class="card-body">Your authorized records and features will appear here.</div></div>
                    </div>
                </main>
                @include('partials.footer')
            </div>
        </div>
        @include('partials.scripts')
    </body>
</html>
