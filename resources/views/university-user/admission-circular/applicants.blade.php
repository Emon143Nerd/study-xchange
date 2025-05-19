@extends('university-user.master')

@section('title','Manage Applicants')

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
                            <i class="fa-solid fa-file-lines me-1"></i>Admission Circular List <p class="alert-success">{{session('message')}}</p>
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
                                        <th>Admission Circular Title</th>
                                        <th>Applicant Name</th>
                                        <th>CGPA</th>
                                        <th>Acceptance</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($applicants as $applicant)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$applicant->admissionCircular->title}}</td>
                                            <td>{{$applicant->full_name}}</td>
                                            <td>{{$applicant->gpa}}</td>
                                            <td>
                                                {{ $applicant->acceptance == 1 ? 'Approved' : 'Not Approved' }}
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{route('university-user.applicants.detail',$applicant->id)}}"
                                                   class="btn btn-warning btn-sm content-icon">
                                                    <i class="fa-solid fa-pen-to-square"></i>
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
