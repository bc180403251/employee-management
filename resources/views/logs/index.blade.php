@extends('layouts.app')
@section('content')
    <div class="content-header" style="width: 100%">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Employees') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addEmployeeModal">
                        {{ __('Add Employee') }}
                    </button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        </script>
    @endif

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table-list  table table-bordered table-striped table-hover " style="width: 100%" >
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Check In Time</th>
                                    <th>Company</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr id="employee-{{$log->id}}">
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->employee->name }}</td>
                                        <td>{{ $log->employee->email }}</td>
                                        <td>{{ $log->check_in_time}}</td>
                                        <td>{{ $log->check_out_time }}</td>
                                        <td>{{ $log->status }}</td>

                                        <td>
                                            <button type="button" class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#viewEmployeeModal" data-action="view" data-id="{{ $employee->id }}">View</button>
                                            <button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#updateEmployeeModal" data-action="update" data-id="{{ $employee->id }}">Update</button>
                                            <button type="button" class="btn btn-danger btn-sm mx-1 delete-btn" data-id="{{ $employee->id }}">{{ __('Delete') }}</button>
                                            {{--                                            <button type="button" class="btn btn-danger btn-sm m-1" data-id="{{ $company->id }}" onclick="deleteCompany({{ $company->id }})">Delete</button>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $employees->links() }}
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
