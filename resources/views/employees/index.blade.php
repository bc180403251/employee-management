@extends('layouts.app')
@section('content')
    <div class="content-header">
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

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table-list  table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Profile</th>
                                    <th>Status</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr id="company-{{$employee->id}}">
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->company->name }}</td>
                                        <td>{{ $employee->profile_img }}</td>
                                        <td>{{ $employee->status }}</td>
                                        <td>{{ $employee->password }}</td>

                                        <td>
                                            <button type="button" class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#viewEmployeeModal" data-action="view" data-id="{{ $employee->id }}">View</button>
                                            <button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#updateCompanyModal" data-action="update" data-id="{{ $employee->id }}">Update</button>
                                            <button type="button" class="btn btn-danger btn-sm mx-1 delete-btn" data-company-id="{{ $employee->id }}">{{ __('Delete') }}</button>
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
{{--    add employee modal--}}

    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <label for="profile">Profile</label>
                            <input type="file" class="form-control" id="profile" name="file" placeholder="Profile URL" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                        </div>

                        <div class="form-group">
                            <label for="company">Company</label>
                            <select class="form-control" id="company" name="company">
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div id="progress-container" class="progress" style="display: none;">
                    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEmployeeBtn">Add Company</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Employee Modal -->
    <div class="modal fade" id="viewEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="viewEmployeeModalLabel">View Employee Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Employee Details Here -->
                    <div class="form-group text-center">
{{--                        <label for="view-profile">Profile</label>--}}
                        <img id="view-profile" src="" alt="Profile Image" class="img-thumbnail rounded" style="max-width: 150px">
                    </div>

                    <div class="form-group">
                        <label for="view-name">Name</label>
                        <p id="view-name"></p>
                    </div>

                    <div class="form-group">
                        <label for="view-email">Email</label>
                        <p id="view-email"></p>
                    </div>

                    <div class="form-group">
                        <label for="view-phone">Phone</label>
                        <p id="view-phone"></p>
                    </div>

                    <div class="form-group">
                        <label for="view-company">Company</label>
                        <p id="view-company"></p>
                    </div>



                    <div class="form-group">
                        <label for="view-status">Status</label>
                        <p id="view-status"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.6/firebase-app.js";
        import { getStorage, ref, uploadBytesResumable, getDownloadURL } from "https://www.gstatic.com/firebasejs/9.6.6/firebase-storage.js";


        // Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyAx5F7-6mFQqG0AMkmwIPXJtTA-mX0FJIs",
            authDomain: "employee-management-4cde8.firebaseapp.com",
            projectId: "employee-management-4cde8",
            storageBucket: "employee-management-4cde8.appspot.com",
            messagingSenderId: "1008778061256",
            appId: "1:1008778061256:web:8e1f0821eb90a011534cfd",
            measurementId: "G-ZF3DRMQPTK"
        }
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const storage = getStorage(app);

        $(document).ready(function() {
            $('#addEmployeeModal').on('show.bs.modal', function (event) {
                $.ajax({
                    url: '{{ route('employees.getCreate') }}',
                    type: 'GET',
                    success: function (response) {
                        var companies = response.companies;
                        var $companyDropdown = $('#company');
                        $companyDropdown.empty(); // Clear existing options

                        // Add a default option
                        $companyDropdown.append('<option value="">Select Company</option>');

                        // Populate dropdown with company names
                        $.each(companies, function(index, company) {
                            $companyDropdown.append(
                                $('<option>', {
                                    value: company.id,
                                    text: company.name
                                })
                            );
                        });
                    },
                    error: function (error) {
                        console.log('Error fetching companies:', error);
                    }
                });
            });
            $('#saveEmployeeBtn').click(async function(e){
                e.preventDefault()

                $('#progress-container').show();

                const file = document.getElementById('profile').files[0];
                const storageRef = ref(storage, 'employees/profile/' + file.name);
                const uploadTask = uploadBytesResumable(storageRef, file);

                let profile='';

                function updateProgress(progress){
                    const progressBar=document.getElementById('progress-bar');
                    progressBar.style.width= progress + '%';
                    progressBar.setAttribute('aria-vluesnow', progress);
                    progressBar.innerText= Math.round(progress)+'%'

                }
                let progressInterval;

                uploadTask.on('state_changed',
                    function (snapshot) {
                        clearInterval(progressInterval);
                        progressInterval=setInterval(()=>{
                            const progress=(snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                            updateProgress(progress);
                        },200);

                    },
                    function (error){
                        clearInterval(progressInterval);
                        console.error('upload failed', error)

                    },
                    async  function () {
                        clearInterval(progressInterval);
                        updateProgress(100);
                        profile= await getDownloadURL(uploadTask.snapshot.ref);

                        let data={
                            name : $('#name').val(),
                            email :$('#email').val(),
                            phone : $('#phone').val(),
                            password:$('#password').val(),
                            profile_img: profile,
                            company_id:$('#company').val(),
                            status:$('#status').val(),
                            _token : $('meta[name="csrf-token"]').attr('content')
                        }
                        console.log(data);

                        $.ajax({
                            url: '{{ route("employees.create") }}',
                            type: 'POST',
                            data: data,
                            success: function(response){
                                console.log(response);
                                $('#addEmployeeModal').modal('hide');
                                location.reload()

                            },
                            error: function(error){
                                console.log(error);
                            }
                        })


                    }
                )

            })
            $('#viewEmployeeModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); // Button that triggered the modal
                const employeeId = button.data('id'); // Extract info from data-* attributes

                $.ajax({
                    url: '{{ url('employees/show') }}/' + employeeId,
                    type: 'GET',
                    // data: { id: employeeId },
                    success: function (response) {
                        console.log(response)
                        const employee = response.employee;
                        $('#view-name').text(employee.name);
                        $('#view-email').text(employee.email);
                        $('#view-phone').text(employee.phone);
                        $('#view-company').text(employee.company.name);
                        $('#view-profile').attr('src', employee.profile_img);
                        $('#view-status').text(employee.status ? 'Active' : 'Inactive');
                    },
                    error: function (error) {
                        console.log('Error fetching employee details:', error);
                    }
                });
            });
        });

    </script>
@endsection
