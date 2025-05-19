@extends('university-user.master')

@section('title','Admission Circular List')

@section('body')

    <!--**********************************
            Content body start
        ***********************************-->

    <div class="content-body default-height">
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <div class="cpa">
                            <i class="fa-solid fa-file-lines me-1"></i>Admission Circular List
                            <div class="media-body">
                                <p class="mb-0">{{session('message')}}</p>
                            </div>
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle"><i
                                    class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt">
                        <div class="card-body pb-4">
                            <div class="table-responsive w-100">
                                <table id="example3" class="display min-w850 w-100">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Total Fees</th>
                                        <th>Min CGPA Req</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Attachment</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admissionCirculars as $admissionCircular)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ \Illuminate\Support\Str::limit(ucfirst(strtolower($admissionCircular->university_name)), 15, '...') }}</td>
                                            <td>{{$admissionCircular->total_fees}}</td>
                                            <td>{{$admissionCircular->min_cgpa_req}}</td>
                                            <td>{{ \Carbon\Carbon::parse($admissionCircular->start_date)->format('d F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($admissionCircular->end_date)->format('d F Y') }}</td>
                                            <td>{{$admissionCircular->status}}</td>
                                            <td><img src="{{asset($admissionCircular->image)}}" width="100" alt=""></td>
                                            <td>
                                                @if(in_array(pathinfo($admissionCircular->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($admissionCircular->attachment) }}" width="100" alt="">
                                                @else
                                                    <a href="{{ asset($admissionCircular->attachment) }}" target="_blank">
                                                        <i class="fa-solid fa-file"></i> View Attachment
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{route('university-user.admission-circular.edit', ['slug'=>$admissionCircular->slug])}}"
                                                   class="btn btn-warning btn-sm content-icon">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{route('university-user.admission-circular.delete', ['slug'=>$admissionCircular->slug])}}"
                                                   class="btn btn-danger btn-sm content-icon">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
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
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

@endsection




