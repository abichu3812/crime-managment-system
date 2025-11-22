@extends('admin.admin_dashboard')
@section('admin')

<style>
.form-label {
    color: white;
    font-weight: bold;
    font-size: 15px;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content" style="margin-top:28px;">

    <div class="row profile-body">
        <!-- left wrapper start -->

        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-success mb-4" style="font-size: 1.75rem; font-weight: 600;">
                            <i class="fas fa-user-plus me-2"></i>Register New Staff
                        </h4>

                        <form class="forms-sample" method="POST" action="{{route('admin.store')}}"
                            enctype='multipart/form-data' novalidate>
                            @csrf
                            <div class="row g-4">
                                <!-- Error Summary -->
                                @if($errors->any())
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif

                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder=" " value="{{ old('name') }}" autofocus>
                                        <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder=" " value="{{ old('email') }}">
                                        <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="form-floating mb-3 position-relative">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" placeholder=" " style="padding-right: 65px;">
                                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                        <button type="button"
                                            class="btn btn-link position-absolute end-0 top-50 translate-middle-y"
                                            style="right: 10px;" onclick="togglePassword()">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" name="username" placeholder=" " value="{{ old('username') }}">
                                        <label for="username"><i class="fas fa-at me-2"></i>Username</label>
                                        @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                                        <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                        @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-camera me-2"></i>Profile
                                            Photo</label>
                                        <div class="custom-file">
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                                id="photo" name="photo" accept="image/*">
                                            <label class="custom-file-label" for="photo">Choose file</label>
                                            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <small class="form-text text-muted">Max size: 2MB (JPEG, PNG)</small>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" placeholder=" " value="{{ old('phone') }}">
                                        <label for="phone"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>





                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" placeholder=" " value="{{ old('address') }}">
                                        <label for="address"><i class="fas fa-map-marker-alt me-2"></i>Address</label>
                                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-user-tag me-2"></i>Role</label>
                                        <select class="form-select @error('role') is-invalid @enderror" name="role">
                                            <option value="" selected disabled>Select Role</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="inspector"
                                                {{ old('role') == 'inspector' ? 'selected' : '' }}>
                                                Inspector
                                            </option>
                                            <option value="investigator"
                                                {{ old('role') == 'investigator' ? 'selected' : '' }}>
                                                Investigator
                                            </option>
                                            <option value="commander"
                                                {{ old('role') == 'commander' ? 'selected' : '' }}>
                                                Commander
                                            </option>
                                            <option value="register_office"
                                                {{ old('role') == 'register_office' ? 'selected' : '' }}>Register Office
                                            </option>
                                        </select>
                                        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-toggle-on me-2"></i>Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" name="status">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"
                                                {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="submit" class="btn btn-success btn-lg px-4">
                                    <i class="fas fa-user-plus me-2"></i>Register Staff
                                </button>
                            </div>
                        </form>
                    </div>

                    <script>
                    // Dynamic Department Update


                    // Password Toggle
                    function togglePassword() {
                        const password = document.getElementById('password');
                        const icon = document.querySelector('#password + button i');
                        if (password.type === 'password') {
                            password.type = 'text';
                            icon.classList.replace('fa-eye', 'fa-eye-slash');
                        } else {
                            password.type = 'password';
                            icon.classList.replace('fa-eye-slash', 'fa-eye');
                        }
                    }

                    // File Input Label Update
                    document.getElementById('photo').addEventListener('change', function(e) {
                        const fileName = e.target.files[0]?.name || 'Choose file';
                        document.querySelector('.custom-file-label').textContent = fileName;
                    });
                    </script>

                    <style>
                    .form-floating label {
                        padding-left: 2.5rem;
                    }

                    .form-floating i {
                        position: absolute;
                        left: 1rem;
                        top: 50%;
                        transform: translateY(-50%);
                        color: #6c757d;
                    }

                    .custom-file-label {
                        overflow: hidden;
                        text-overflow: ellipsis;
                        white-space: nowrap;
                    }

                    .btn-success {
                        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
                        transition: transform 0.2s;
                    }

                    .btn-success:hover {
                        transform: translateY(-2px);
                    }
                    </style>

                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>

    </div>


    @endsection