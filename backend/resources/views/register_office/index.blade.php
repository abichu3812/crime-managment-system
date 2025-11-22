@extends('register_office.register_office_dashboard')
@section('register_office')

<div class="page-content">
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
        $gender = $profileData->gender === 'male' ? 'Mr.' : ($profileData->gender === 'female' ? 'Ms.' : '');
    @endphp

    <div class="d-flex flex-column align-items-start gap-3">
        <div class="welcome-section text-center mb-4">
            <h3 class="mb-2">
                Welcome to {{$profileData->name}} Dashboard
                <span style="color: yellow; font-size: 30px;"></span>
            </h3>
            
        </div>

        <div class="actions-section" style="width: 100%;">
            <div class="card p-4 shadow">
                <h5 class="card-title text-center mb-4">Quick Actions</h5>
                <div class="row g-4">
                    <div class="col-md-4">
                        <form action="{{route('RegisterOffice.recordcriminalinformation')}}" method="GET">
                            <button 
                                type="submit" 
                                class="btn btn-success btn-lg w-100 p-4 shadow-sm" 
                                style="height: 150px; font-size: 1.25rem;">
                                Record Criminal Information
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
