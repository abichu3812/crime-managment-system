@extends('investigator.investigator_dashboard')
@section('investigator')

<div class="page-content" style="padding: 25px 15px;">

    <!-- Breadcrumb Navigation -->

    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp
    <!-- Members Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="card-title text-center" style="color: yellow; font-size: 20px;">
                        <i class="fas fa-users"></i> All Members
                    </h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background-color: #003f00;">
                                    <th style="font-size: 17px; color: white; font-weight: bold;">ID</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Name</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Username</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Email</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Role</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Photo</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Gender</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">College</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Department</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Phone</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Address</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Status</th>
                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $key => $items)
                                @if ($profileData->department == $items->department)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $items->name }}</td>
                                        <td>{{ $items->username }}</td>
                                        <td>{{ $items->email }}</td>
                                        <td>{{ $items->role }}</td>
                                        <td>
                                            <img class="wd-100 rounded-circle" 
                                                 src="{{ !empty($items->photo) ? url('upload/admin_image/' . $items->photo) : url('upload/no_image.jpg') }}" 
                                                 alt="profile" 
                                                 style="width: 50px; height: 50px;">
                                        </td>
                                        <td>{{ $items->gender }}</td>
                                        <td>{{ $items->collage }}</td>
                                        <td>{{ $items->department }}</td>
                                        <td>{{ $items->phone }}</td>
                                        <td>{{ $items->address }}</td>
                                        <td>{{ $items->status }}</td>
                                     
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
