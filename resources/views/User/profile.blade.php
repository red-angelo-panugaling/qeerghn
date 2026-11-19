<!DOCTYPE html>
<html lang="en">
    @section('title', 'My Profile')
    @include('partials.header')

    <body class="sb-nav-fixed">
        @include('partials.navbar')
        <div id="layoutSidenav">
            @include('partials.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
                        </ol>
                    </div>
                    @include('partials.profile')
                </main>
                @include('partials.footer')
            </div>
        </div>
        @include('partials.scripts')
    </body>
</html>
