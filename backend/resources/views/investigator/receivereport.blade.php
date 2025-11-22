@extends('investigator.investigator_dashboard')
@section('investigator')

<div class="page-content" style="padding: 25px 15px;">



    <!-- Members Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="card-title text-center" style="color: yellow; font-size: 20px;">
                        <i class="fas fa-users"></i> Received From investigaton Leader
                    </h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background-color: #003f00;">
                                <th style="font-size: 17px; color: white; font-weight: bold;">ID</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Full Name</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Age</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Gender</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Description</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Address</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Last Known Location</th>
                                    
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Status</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $key => $items)
                                    <tr>
                                    <td>{{ $key + 1 }}</td>
                                        <td>{{ $items->full_name }}</td>
                                    
                                        <td>{{ $items->age }}</td>
                                        <td>{{ $items->gender }}</td>
                                        <td>{{ $items->description }}</td>
                                        <td>{{ $items->address }}</td>
 
                                        <td>{{ $items->last_known_location }}</td>

                                       
                                
                                        <td>{{ $items->status }}</td>
                            
                                
                        
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
