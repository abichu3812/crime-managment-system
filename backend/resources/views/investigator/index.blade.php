@extends('investigator.investigator_dashboard')
@section('investigator')

<div class="page-content">

    @php
        $id = Auth::user()->id;
        $profileData =App\Models\User::find($id);
        $gender = $profileData->gender === 'male' ? 'Mr.' : ($profileData->gender === 'female' ? 'Ms.' : '');
    @endphp

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to  {{$gender}} <span style="color: rgb(255, 255, 0);font-size: 25px;">{{$profileData->name}} Dashboard</span></h4>
        </div>

    </div> <!-- row -->
  

</div>


@endsection