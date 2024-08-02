@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Companies') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addCompanyModal">
                        {{ __('Add Company') }}
                    </button>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table-list table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>LOGO</th>
                                    <th>Website</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Password</th>
                                    <th>Screenshot time</th>
                                    <th>No. OF Employees</th>
                                    <th>Allowed Email</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- DataTables will populate this -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.3/js/jquery.dataTables.min.js"></script>



<script type="text/javascript">
    $(document).ready(function () {
        $('.table-list').DataTable({
            processData:true,
            serverSide:true,
            ajax:{
                url:"{{url('companies/listAll')}}",
                method:"GET"
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'logo', name: 'logo' },
                { data: 'website', name: 'website' },
                { data: 'phone', name: 'phone' },
                { data: 'address', name: 'address' },
                { data: 'password', name: 'password' },
                { data: 'screenshot_time', name: 'screenshot_time' },
                { data: 'no_of_employees', name: 'no_of_employees' },
                { data: 'allowed_email', name: 'allowed_email' },
                { data: 'status', name: 'status' },
            ]

        })


    });
</script>

