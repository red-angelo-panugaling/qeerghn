<div class="container-fluid px-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4" id="profile">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="fas fa-user me-1"></i> My Profile</span>
                    <button class="btn btn-sm btn-outline-primary" id="editProfileButton" type="button" aria-controls="profile-edit" aria-expanded="{{ $errors->any() ? 'true' : 'false' }}">
                        <i class="fas fa-pen me-1"></i> Edit Profile
                    </button>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <div id="profile-view" @class(['d-none' => $errors->any()])>
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Full Name</dt><dd class="col-sm-8">{{ auth()->user()->full_name ?: 'Not provided' }}</dd>
                            <dt class="col-sm-4">Username</dt><dd class="col-sm-8">{{ auth()->user()->username ?: 'Not provided' }}</dd>
                            <dt class="col-sm-4">Email Address</dt><dd class="col-sm-8">{{ auth()->user()->email }}</dd>
                            <dt class="col-sm-4">Role</dt><dd class="col-sm-8">{{ auth()->user()->role }}</dd>
                            <dt class="col-sm-4">Account Status</dt><dd class="col-sm-8"><span class="badge bg-{{ auth()->user()->status ? 'success' : 'danger' }}">{{ auth()->user()->status ? 'Active' : 'Inactive' }}</span></dd>
                        </dl>
                    </div>

                    <div id="profile-edit" @class(['d-none' => ! $errors->any()])>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="full_name">Full Name</label>
                                <input class="form-control" id="full_name" name="full_name" type="text" value="{{ old('full_name', auth()->user()->full_name) }}" required maxlength="255" autocomplete="name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" id="username" name="username" type="text" value="{{ old('username', auth()->user()->username) }}" required maxlength="255" autocomplete="username">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input class="form-control" id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required maxlength="255" autocomplete="email">
                            </div>

                            <p class="text-muted">Leave the password fields blank to keep your current password.</p>

                            <div class="mb-3">
                                <label class="form-label" for="password">New Password</label>
                                <input class="form-control" id="password" name="password" type="password" minlength="8" autocomplete="new-password">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password">
                            </div>

                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <button class="btn btn-outline-secondary" id="cancelProfileEditButton" type="button">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-primary mb-4">
                <div class="card-header"><i class="fas fa-id-card me-1"></i> Profile Overview</div>
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px;">
                        <i class="fas fa-user fa-2x" aria-hidden="true"></i>
                    </div>
                    <h2 class="h5 mb-1">{{ auth()->user()->full_name }}</h2>
                    <p class="text-muted mb-3">{{ '@'.auth()->user()->username }}</p>
                    <div class="border-top pt-3 text-start">
                        <div class="small text-muted">User ID</div>
                        <div class="fw-semibold">#{{ auth()->user()->id }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const profileView = document.getElementById('profile-view');
        const profileEdit = document.getElementById('profile-edit');
        const editButton = document.getElementById('editProfileButton');
        const cancelButton = document.getElementById('cancelProfileEditButton');

        const setEditing = (isEditing) => {
            profileView.classList.toggle('d-none', isEditing);
            profileEdit.classList.toggle('d-none', !isEditing);
            editButton.setAttribute('aria-expanded', String(isEditing));
        };

        editButton.addEventListener('click', () => setEditing(true));
        cancelButton.addEventListener('click', () => setEditing(false));

        if (window.location.hash === '#profile-edit') {
            setEditing(true);
        }
    });
</script>
