@extends('investigator.investigator_dashboard')
@section('investigator')

<style>
.form-label {
    color: #333;
    font-weight: bold;
    font-size: 15px;
}

.card-title {
    color: #28a745;
    font-size: 1.75rem;
    font-weight: 600;
}

.custom-file-label::after {
    content: "Browse";
}

.file-upload-wrapper {
    margin-bottom: 1.5rem;
}

.preview-container {
    margin-top: 10px;
}

.preview-media {
    max-width: 100%;
    max-height: 200px;
    display: block;
    margin-top: 10px;
}

.audio-preview {
    width: 100%;
    margin-top: 10px;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content" style="margin-top:28px;">
    <div class="row profile-body">
        <div class="col-md-10 col-xl-10 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">
                            <i class="fas fa-user-plus me-2"></i>Send Investigation Report to Investigator Leader
                        </h4>

                        <form class="forms-sample" method="POST"
                            action="{{route('investigator.sentinvestigationreporttoleader')}}"
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
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                            id="full_name" name="full_name" placeholder=" "
                                            value="{{ old('full_name') }}" autofocus>
                                        <label for="full_name"><i class="fas fa-user me-2"></i>Full Name</label>
                                        @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control @error('age') is-invalid @enderror"
                                            id="age" name="age" placeholder=" " value="{{ old('age') }}" min="1"
                                            max="120">
                                        <label for="age"><i class="fas fa-birthday-cake me-2"></i>Age</label>
                                        @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                        <label class="form-label"><i class="fas fa-comment me-2"></i>Interview
                                            Notes</label>
                                        <textarea class="form-control @error('interview') is-invalid @enderror"
                                            id="interview" name="interview" rows="3">{{ old('interview') }}</textarea>
                                        @error('interview')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Photo Upload -->
                                    <div class="mb-3 file-upload-wrapper">
                                        <label class="form-label"><i class="fas fa-camera me-2"></i>Suspect
                                            Photo</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="form-control @error('personal_photo') is-invalid @enderror"
                                                id="personal_photo" name="personal_photo" accept="image/*">
                                            <label class="custom-file-label" for="personal_photo">Choose file</label>
                                            @error('personal_photo')<div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">Max size: 5MB (JPEG, PNG)</small>
                                        <div class="preview-container" id="photo-preview-container"></div>
                                    </div>

                                    <!-- Video Evidence -->
                                    <div class="mb-3 file-upload-wrapper">
                                        <label class="form-label"><i class="fas fa-video me-2"></i>Video
                                            Evidence</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="form-control @error('video_evidence') is-invalid @enderror"
                                                id="video_evidence" name="video_evidence" accept="video/*">
                                            <label class="custom-file-label" for="video_evidence">Choose file</label>
                                            @error('video_evidence')<div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">Max size: 20MB (MP4, MOV)</small>
                                        <div class="preview-container" id="video-preview-container"></div>
                                    </div>

                                    <!-- Audio Evidence -->
                                    <div class="mb-3 file-upload-wrapper">
                                        <label class="form-label"><i class="fas fa-microphone me-2"></i>Audio
                                            Evidence</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="form-control @error('audio_evidence') is-invalid @enderror"
                                                id="audio_evidence" name="audio_evidence" accept="audio/*">
                                            <label class="custom-file-label" for="audio_evidence">Choose file</label>
                                            @error('audio_evidence')<div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">Max size: 10MB (MP3, WAV)</small>
                                        <div class="preview-container" id="audio-preview-container"></div>
                                    </div>

                                    <!-- DNA Evidence -->
                                    <div class="mb-3 file-upload-wrapper">
                                        <label class="form-label"><i class="fas fa-dna me-2"></i>DNA Evidence</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                class="form-control @error('dna_evidence') is-invalid @enderror"
                                                id="dna_evidence" name="dna_evidence" accept="image/*,.pdf,.doc,.docx">
                                            <label class="custom-file-label" for="dna_evidence">Choose file</label>
                                            @error('dna_evidence')<div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">Max size: 5MB (Images, PDF, DOC)</small>
                                    </div>
                                </div>

                                <!-- Full Width Fields -->
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-file-alt me-2"></i>Additional
                                            Notes</label>
                                        <textarea class="form-control @error('additional_notes') is-invalid @enderror"
                                            id="additional_notes" name="additional_notes"
                                            rows="4">{{ old('additional_notes') }}</textarea>
                                        @error('additional_notes')<div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="submit" class="btn btn-success btn-lg px-4">
                                    <i class="fas fa-paper-plane me-2"></i>Send To Investigator Leader
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// File input change handlers with preview
$(document).ready(function() {
    // Photo preview
    $('#personal_photo').change(function(e) {
        const file = e.target.files[0];
        const container = $('#photo-preview-container');
        container.empty();

        if (file && file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.append(
                    `<img src="${e.target.result}" class="preview-media" alt="Photo preview">`);
            }
            reader.readAsDataURL(file);
            $(this).next('.custom-file-label').text(file.name);
        }
    });

    // Video preview
    $('#video_evidence').change(function(e) {
        const file = e.target.files[0];
        const container = $('#video-preview-container');
        container.empty();

        if (file && file.type.match('video.*')) {
            const url = URL.createObjectURL(file);
            container.append(`
                    <video controls class="preview-media">
                        <source src="${url}" type="${file.type}">
                        Your browser does not support the video tag.
                    </video>
                `);
            $(this).next('.custom-file-label').text(file.name);
        }
    });

    // Audio preview
    $('#audio_evidence').change(function(e) {
        const file = e.target.files[0];
        const container = $('#audio-preview-container');
        container.empty();

        if (file && file.type.match('audio.*')) {
            const url = URL.createObjectURL(file);
            container.append(`
                    <audio controls class="audio-preview">
                        <source src="${url}" type="${file.type}">
                        Your browser does not support the audio element.
                    </audio>
                `);
            $(this).next('.custom-file-label').text(file.name);
        }
    });

    // Update file input labels
    $('input[type="file"]').change(function() {
        const fileName = $(this).val().split('\\').pop();
        if (fileName) {
            $(this).next('.custom-file-label').text(fileName);
        }
    });
});

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Example validation for file sizes
    const forms = document.getElementsByClassName('forms-sample');
    Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}, false);
</script>

@endsection