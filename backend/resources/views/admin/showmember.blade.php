@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content" style="padding: 25px 15px;">

    <!-- Breadcrumb Navigation -->
    <nav class="page-breadcrumb mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.addmember') }}" class="btn btn-outline-success">
                    <i class="fas fa-user-plus"></i>Register new Staff
                </a>
            </li>
        </ol>
    </nav>

    <!-- Members Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="card-title text-center" style="color: yellow; font-size: 20px;">
                        <i class="fas fa-users"></i> All Staffs
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
                                    <th style="font-size: 17px; color: white; font-weight: bold;">TeamName</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Department</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Phone</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Address</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Status</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $key => $items)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $items->name }}</td>
                                    <td>{{ $items->username }}</td>
                                    <td>{{ $items->email }}</td>
                                    <td>{{ $items->role }}</td>
                                    <td>
                                        <img class="wd-100 rounded-circle"
                                            src="{{ !empty($items->photo) ? url('upload/admin_image/' . $items->photo) : url('upload/no_image.jpg') }}"
                                            alt="profile" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $items->gender }}</td>
                                    <td>{{ $items->teamname }}</td>
                                    <td>{{ $items->department }}</td>
                                    <td>{{ $items->phone }}</td>
                                    <td>{{ $items->address }}</td>
                                    <td>
                                        <form action="{{route('admin.statuschange',$items->id)}}" method="POST">
                                            @csrf
                                            @if($items->status==='inactive')
                                            <input class="btn btn-danger" type="submit" value="{{$items->status}}">
                                            @endif
                                            @if($items->status==='active')
                                            <input class="btn btn-outline-success" type="submit"
                                                value="{{$items->status}}">
                                            @endif
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.editmember', $items->id) }}"
                                                class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('admin.deletemember', $items->id) }}"
                                                class="btn btn-outline-danger btn-sm" id="delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
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