@extends('register_office.register_office_dashboard')
@section('register_office')

<style>
    .form-label{
        color:white;
        font-weight:bold;
        font-size:15px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content" style="margin-top:28px;">

<div class="row profile-body">
  <!-- left wrapper start -->

  <!-- left wrapper end -->
  <!-- middle wrapper start -->
  <div class="col-md-11 col-xl-11 middle-wrapper">
    <div class="row">
    <div class="card">
    <div class="card-body">
    <h4 class="card-title text-success mb-4" style="font-size: 1.75rem; font-weight: 600;">
        <i class="fas fa-user-plus me-2"></i>Record Criminal Information
    </h4>

    <form  class="forms-sample" method="POST" action="{{route('registeroffice.storecriminalrecord')}}" enctype='multipart/form-data' novalidate>
        @csrf
        <div class="row g-4">
            <!-- Error Summary -->
            @if($errors->any())
            <div class="col-18">
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
            <div class="col-md-4">
                <h3 style="margin-bottom: 10px;">Personal Information</h3>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('fname') is-invalid @enderror" 
                           id="fname" name="fname" placeholder=" " value="{{ old('fname') }}" autofocus>
                    <label for="fname"><i class="fas fa-user me-2"></i>First Name</label>
                    @error('fname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('mname') is-invalid @enderror" 
                           id="mname" name="mname" placeholder=" " value="{{ old('mname') }}" autofocus>
                    <label for="mname"><i class="fas fa-user me-2"></i>Middle Name</label>
                    @error('mname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('lname') is-invalid @enderror" 
                           id="lname" name="lname" placeholder=" " value="{{ old('lname') }}" autofocus>
                    <label for="lname"><i class="fas fa-user me-2"></i>Last Name</label>
                    @error('lname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('nickname') is-invalid @enderror" 
                           id="nickname" name="nickname" placeholder=" " value="{{ old('nickname') }}">
                    <label for="nickname"><i class="fas fa-at me-2"></i>Nickname</label>
                    @error('nickname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                    <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-camera me-2"></i>Criminal Photo</label>
                    <div class="custom-file">
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" name="photo" accept="image/*">
                        <label class="custom-file-label" for="photo">Choose file</label>
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <small class="form-text text-muted">Max size: 2MB (JPEG, PNG)</small>
                </div>
                                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                           id="nationality" name="nationality" placeholder=" " value="{{ old('nationality') }}">
                    <label for="nationality"><i class="fas fa-at me-2"></i>Nationality</label>
                    @error('nationality')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('idnumber') is-invalid @enderror" 
                           id="idnumber" name="idnumber" placeholder=" " value="{{ old('idnumber') }}">
                    <label for="idnumber"><i class="fas fa-at me-2"></i>ID Numbers</label>
                    @error('idnumber')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" 
                           id="address" name="address" placeholder=" " value="{{ old('address') }}">
                    <label for="address"><i class="fas fa-map-marker-alt me-2"></i>Address</label>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
            <h3 style="margin-bottom: 10px;">Crime Details</h3>

                

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('recordnumber') is-invalid @enderror" 
                        id="recordnumber" name="recordnumber" placeholder=" " value="{{ old('recordnumber') }}">
                <label for="recordnumber"><i class="fas fa-map-marker-alt me-2"></i>Case/Record Number</label>
                @error('recordnumber')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('typeofcrime') is-invalid @enderror" 
                        id="typeofcrime" name="typeofcrime" placeholder=" " value="{{ old('typeofcrime') }}">
                <label for="typeofcrime"><i class="fas fa-map-marker-alt me-2"></i>Type of Crime</label>
                @error('typeofcrime')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('courtname') is-invalid @enderror" 
                        id="courtname" name="courtname" placeholder=" " value="{{ old('courtname') }}">
                <label for="courtname"><i class="fas fa-map-marker-alt me-2"></i>Court Name & Judge</label>
                @error('courtname')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('arrestdate') is-invalid @enderror" 
                        id="arrestdate" name="arrestdate" placeholder=" " value="{{ old('arrestdate') }}">
                <label for="arrestdate"><i class="fas fa-map-marker-alt me-2"></i>Arrest Date</label>
                @error('arrestdate')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('releasedate') is-invalid @enderror" 
                        id="releasedate" name="releasedate" placeholder=" " value="{{ old('releasedate') }}">
                <label for="releasedate"><i class="fas fa-map-marker-alt me-2"></i>Release Date (if imprisoned)</label>
                @error('releasedate')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            



            </div>
            <div class="col-md-4">
                <h3 style="margin-bottom: 10px;">Closest Family Information</h3>
                <div class="form-floating mb-3">
                <input type="text" class="form-control @error('familyname') is-invalid @enderror" 
                        id="familyname" name="familyname" placeholder=" " value="{{ old('familyname') }}">
                <label for="familyname"><i class="fas fa-map-marker-alt me-2"></i>Family Full Name</label>
                @error('familyname')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('relationship') is-invalid @enderror" 
                        id="relationship" name="relationship" placeholder=" " value="{{ old('relationship') }}">
                <label for="relationship"><i class="fas fa-map-marker-alt me-2"></i>Relationship </label>
                @error('relationship')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('contactinfo') is-invalid @enderror" 
                        id="contactinfo" name="contactinfo" placeholder=" " value="{{ old('contactinfo') }}">
                <label for="contactinfo"><i class="fas fa-map-marker-alt me-2"></i>Contact Information(Phone) </label>
                @error('contactinfo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            </div>

            </div>
        </div>


        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <button type="submit" class="btn btn-outline-success">
                <i class="fas fa-user-plus me-2"></i>Record Criminal Information
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