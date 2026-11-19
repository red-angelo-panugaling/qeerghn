<!DOCTYPE html>
<html lang="en">
    @section('title', 'Tables')
    @include('partials.header')

    <body class="sb-nav-fixed">
        @include('partials.navbar')
        <div id="layoutSidenav">
            @include('partials.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4"><li class="breadcrumb-item active">Tables</li></ol>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table me-1"></i> DataTable Example</div>
                            <div class="card-body">
                                <table id="datatablesSimple" data-per-page="10">
                                    <thead><tr><th>Name</th><th>Position</th><th>Office</th><th>Age</th><th>Start date</th><th>Salary</th></tr></thead>
                                    <tbody>
                                        @forelse ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->position }}</td>
                                                <td>{{ $employee->office }}</td>
                                                <td>{{ $employee->age ?? '—' }}</td>
                                                <td>{{ $employee->start_date->format('Y/m/d') }}</td>
                                                <td>${{ number_format((float) $employee->salary, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="6" class="text-center text-muted">No employee records available.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                @include('partials.footer')
            </div>
        </div>
        @include('partials.scripts')
    </body>
</html>
