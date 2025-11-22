<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criminal Activity Reporting Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: rgba(51, 3, 14, 0.85);
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        textarea,
        select,
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 120px;
            resize: vertical;
        }
        .required:after {
            content: " *";
            color: red;
        }
        .btn-submit {
            background-color: #2c3e50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .btn-submit:hover {
            background-color: #1a252f;
        }
        .disclaimer {
            font-size: 14px;
            color: #666;
            margin-top: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #2c3e50;
        }
        .emergency-note {
            color: red;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .language-toggle {
            text-align: right;
            margin-bottom: 20px;
        }
        .language-btn {
            background: none;
            border: 1px solid #2c3e50;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }
        .language-btn.active {
            background-color: #2c3e50;
            color: white;
        }
        .amharic {
            font-family: 'Nyala', 'Abyssinica SIL', 'GF Zemen Unicode', Arial, sans-serif;
            direction: rtl;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .form-floating {
            position: relative;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, 
                        border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="language-toggle">
            <button id="lang-en" class="language-btn active">English</button>
            <button id="lang-am" class="language-btn">አማርኛ</button>
        </div>
        
        <h1 class="lang-en">Criminal Activity Reporting Form</h1>
        <h1 class="lang-am" style="display:none;">የወንጀል ሪፖርት ፎርም</h1>
        
        <form class="forms-sample" method="POST" action="{{route('criminalstore')}}" enctype="multipart/form-data" id="crimeReportForm">
            @csrf
            <div class="row">
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
                    <div class="form-group">
                        <label for="name" class="required">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email') }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">Report (using image)</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                            id="photo" name="photo" accept="image/*">
                        <small class="form-text text-muted">Max size: 2MB (JPEG, PNG)</small>
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="repotext">Report Text</label>
                        <input type="text" class="form-control @error('repotext') is-invalid @enderror" 
                            id="repotext" name="repotext" value="{{ old('repotext') }}">
                        @error('repotext')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="required">Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                            id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" 
                            id="address" name="address" value="{{ old('address') }}">
                        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">
                    <span class="lang-en">Submit Report</span>
                    <span class="lang-am" style="display:none;">ሪፖርት አስገባ</span>
                </button>
            </div>
        </form>
    </div>
    
    <script>
        // Language toggle functionality
        document.getElementById('lang-en').addEventListener('click', function() {
            document.querySelectorAll('.lang-en').forEach(el => el.style.display = '');
            document.querySelectorAll('.lang-am').forEach(el => el.style.display = 'none');
            document.getElementById('lang-en').classList.add('active');
            document.getElementById('lang-am').classList.remove('active');
            document.documentElement.lang = 'en';
        });
        
        document.getElementById('lang-am').addEventListener('click', function() {
            document.querySelectorAll('.lang-en').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.lang-am').forEach(el => el.style.display = '');
            document.getElementById('lang-en').classList.remove('active');
            document.getElementById('lang-am').classList.add('active');
            document.documentElement.lang = 'am';
        });
        
    
        document.getElementById('crimeReportForm').addEventListener('submit', function(e) {
            let isValid = true;
            
        
            const requiredFields = document.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const errorMsg = document.documentElement.lang === 'en' ? 
                    'Please fill in all required fields' :
                    'እባክዎ ሁሉንም አስፈላጊ መስኮች ይሙሉ';
                alert(errorMsg);
            }
            
            return isValid;
        });
        
    
        document.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    </script>
</body>
</html>