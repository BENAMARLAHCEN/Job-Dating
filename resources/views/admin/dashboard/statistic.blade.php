@extends('admin/layout/app')
@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3 ">
            <div class="card  order-card px-3 py-2 h-100">
                <div class="card-block">
                    <h6 class="m-b-20">Users Received</h6>
                    <h2 class="text-right"><span>{{$numUsers}}</span></h2>
                     
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3 ">
            <div class="card  order-card px-3 py-2 h-100">
                <div class="card-block">
                    <h6 class="m-b-20">Announcements Received</h6>
                    <h2 class="text-right"><span>{{$numAnnouncements}}</span></h2>
                     
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3 ">
            <div class="card  order-card px-3 py-2 h-100">
                <div class="card-block">
                    <h6 class="m-b-20">Companies Received</h6>
                    <h2 class="text-right"><span>{{$numCompanies}}</span></h2>
                     
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3 ">
            <div class="card  order-card px-3 py-2 h-100">
                <div class="card-block">
                    <h6 class="m-b-20">Attendances Received</h6>
                    <h2 class="text-right"><span>{{$numAttendance}}</span></h2>
                     
                </div>
            </div>
        </div>
	</div>
    <div class="mt-4">
        <h2>
            Top Announcements
        </h2>
    </div>
    <div>
        <table class="table table-striped">
            <thead class="bg-light">
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Skills</th>
                    <th>Description</th>
                    <th>Attendances</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topAnnouncements as $announcement)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                
                                
                                    <p class="fw-bold mb-1">{{ $announcement->title }}</p>
                                </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $announcement->date }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $announcement->location }}</p>
                        </td>
                        <td class=" text-overflow">
                            @foreach ($announcement->skills as $skill)
                                {{ $skill->name }}
                            @endforeach
                        </td>
                        <td class=" text-overflow">
                            {{ $announcement->description }}
                        </td>
                        <td>
                            {{ $announcement->attendances->count() }}
                        </td>
    
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
