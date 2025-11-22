@extends('investigation_leader.investigation_leader_dashboard')
@section('investigation_leader')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
        <!-- Middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Add important description and send to Investigator</h1>

                        <form class="forms-sample" method="POST" action="{{ route('investigatorLeader.senttoinvestigator') }}" enctype="multipart/form-data">
                        @csrf	
                        <input type="hidden" name="id" value="{{ $types->id }}">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                name="full_name" placeholder="Update last known location" 
                                value="{{ old('full_name', $types->full_name) }}" readonly>
                            @error('full_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

         

                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control @error('age') is-invalid @enderror" 
                                name="age" placeholder="Update last known location" 
                                value="{{ old('age', $types->age) }}" readonly>
                            @error('age')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <input type="text" class="form-control @error('gender') is-invalid @enderror" 
                                name="gender" placeholder="Update last known location" 
                                value="{{ old('gender', $types->gender) }}" readonly>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" 
                                name="description" placeholder="Update last known location" 
                                value="{{ old('description', $types->description) }}" readonly>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

            
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                name="address" placeholder="Update last known location" 
                                value="{{ old('address', $types->address) }}" readonly>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                

                        <div class="mb-3">
                            <label class="form-label">Last known location</label>
                            <input type="text" class="form-control @error('last_known_location') is-invalid @enderror" 
                                name="last_known_location" placeholder="Update last known location" 
                                value="{{ old('last_known_location', $types->last_known_location) }}" readonly>
                            @error('last_known_location')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="missing" {{ old('status', $types->status) == 'missing' ? 'selected' : '' }}>Missing</option>
                                <option value="found" {{ old('status', $types->status) == 'found' ? 'selected' : '' }}>Found</option>
                                <option value="investigating" {{ old('status', $types->status) == 'investigating' ? 'selected' : '' }}>Investigating</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Send to Investigator</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Middle wrapper end -->
    </div>
</div>

@endsection
