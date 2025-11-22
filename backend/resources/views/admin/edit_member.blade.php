@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <!-- Middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit Profile</h6>

                        <form class="forms-sample" method="POST" action="{{ route('admin.updatemember') }}" enctype="multipart/form-data">
                            @csrf	
                            <input type="hidden" name="id" value="{{ $types->id }}">

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name', $types->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email', $types->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password', $types->password) }}">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username', $types->username) }}">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option disabled {{ old('gender', $types->gender) == '' ? 'selected' : '' }}>Select Gender</option>
                                    <option value="male" {{ old('gender', $types->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $types->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" placeholder="Photo" id="image">
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone" value="{{ old('phone', $types->phone) }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">College</label>
                                <input type="text" class="form-control @error('collage') is-invalid @enderror" name="collage" placeholder="College" value="{{ old('collage', $types->collage) }}">
                                @error('collage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" class="form-control @error('department') is-invalid @enderror" name="department" placeholder="Department" value="{{ old('department', $types->department) }}">
                                @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" value="{{ old('address', $types->address) }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option disabled {{ old('role', $types->role) == '' ? 'selected' : '' }}>Select Role</option>
                                    <option value="admin" {{ old('role', $types->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="collage_dean" {{ old('role', $types->role) == 'collage_dean' ? 'selected' : '' }}>Collage Dean</option>
                                    <option value="collage_registral" {{ old('role', $types->role) == 'collage_registral' ? 'selected' : '' }}>Collage Registral</option>
                                    <option value="investigator" {{ old('role', $types->role) == 'investigator' ? 'selected' : '' }}>Department Head</option>
                                    <option value="stuff" {{ old('role', $types->role) == 'stuff' ? 'selected' : '' }}>Staff</option>
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" placeholder="Status" value="{{ old('status', $types->status) }}">
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Middle wrapper end -->
    </div>
</div>

@endsection
