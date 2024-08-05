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
                                    <th>Phone</th>
                                    <th>Company</th>
{{--                                    <th>Profile</th>--}}
{{--                                    <th>Status</th>--}}
{{--                                    <th>Password</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr id="employee-{{$employee->id}}">
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->company->name }}</td>
{{--                                        <td>{{ $employee->profile_img }}</td>--}}
{{--                                        <td>{{ $employee->status }}</td>--}}
{{--                                        <td>{{ $employee->password }}</td>--}}

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
{{--    add employee modal--}}

    <div class="modal fade " id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="company">Company</label>
                                <select class="form-control" id="company" name="company">
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="profile">Profile</label>
                                <input type="file" class="form-control" id="profile" name="file" placeholder="Profile URL" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="create-progress-container" class="progress mx-3" style="display: none;">
                    <div id="create-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated m-auto" role="progressbar"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveEmployeeBtn">Add Employee</button>
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
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">

                        <!-- Text Details -->
                        <div class="d-flex flex-column mt-3">
                            <div class="form-group">
                                <label for="view-name">Name</label>
                                <p id="view-name"></p>
                            </div>
                            <div class="form-group">
                                <label for="view-email">Email</label>
                                <p id="view-email"></p>
                            </div>
                        </div>

                        <!-- Profile Image -->
                        `<div class="form-group">
                            <img id="view-profile" src="" alt="https://firebasestorage.googleapis.com/v0/b/employee-management-4cde8.appspot.com/o/alt%20images%2Fuser_icon_001.jpg?alt=media&token=6e12626e-f597-4c50-8834-0fc25c8acb3a" class="img-thumbnail rounded" style="max-width: 200px; margin-right: 40px">
                        </div>`
                    </div>

                    <!-- Additional Fields in Two Columns -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view-phone">Phone</label>
                                <p id="view-phone"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view-company">Company</label>
                                <p id="view-company"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view-status">Status</label>
                                <p id="view-status"></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-- Update Employee Modal -->
    <div class="modal fade" id="updateEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="updateEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="updateEmployeeModalLabel">Update Employee Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateEmployeeForm" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="hidden" id="update-employee-id">

                        <div class="d-flex justify-content-between">
                            <!-- Text Fields Area -->
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="form-group">
                                    <label for="update-name">Name</label>
                                    <input type="text" class="form-control" id="update-name" name="name" placeholder="Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="update-email">Email</label>
                                    <input type="email" class="form-control" id="update-email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <!-- Profile Image -->
                            <div class="ml-3">
                                <div class="form-group text-center">
                                    <img id="update-profile-img" src="" alt="" class="img-thumbnail rounded" style="max-width: 200px; margin-right: 35px">
                                </div>
                            </div>

                        </div>

                        <!-- Additional Fields in Two Columns -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="update-phone">Phone</label>
                                <input type="text" class="form-control" id="update-phone" name="phone" placeholder="Phone">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="update-company">Company</label>
                                <select class="form-control" id="update-company" name="company">
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="update-password">Password</label>
                                <input type="password" class="form-control" id="update-password" name="password" placeholder="Password">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="update-status">Status</label>
                                <select class="form-control" id="update-status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <label for="update-profile">Update Profile Image(Optional)</label>
                                <input type="file" class="form-control" id="update-profile" name="profile_img">
                            </div>
                        </div>
                    </form>
                </div>
                <div id="update-progress-container" class="progress mx-3" style="display: none;">
                    <div id="update-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated m-auto" role="progressbar"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updateEmployeeBtn">save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this employee?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
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

        function handleFileUpload(file, onComplete, updateProgress) {

            const storageRef = ref(storage, 'employee/logos/' + file.name);
            const uploadTask = uploadBytesResumable(storageRef, file);

            let progressInterval;



            uploadTask.on('state_changed',
                function (snapshot) {
                    clearInterval(progressInterval);
                    progressInterval = setInterval(() => {
                        const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        updateProgress(progress);
                    }, 200);
                },
                function (error) {
                    clearInterval(progressInterval);
                    console.error('Upload failed', error);
                },
                async function () {
                    clearInterval(progressInterval);
                    updateProgress(100);
                    const downloadURL = await getDownloadURL(uploadTask.snapshot.ref);
                    onComplete(downloadURL);
                }
            );
        }
        function showErrors(errors) {
            // Hide all previous errors
            $('.form-group').find('.text-danger').remove();
            $('.is-invalid').removeClass('is-invalid');

            // Display errors
            $.each(errors, function (field, message) {
                const input = $('#' + field);
                input.addClass('is-invalid');
                input.after('<div class="text-danger">' + message + '</div>');
            });
        }

        function clearErrors(){
            $('.form-group').find('.text-danger').remove();
            $('.is-invalid').removeClass('is-invalid');
        }

        // function  validate form

        function validateForm(){
            let errors={};
            let valid=true;

           const name= $('#name').val();
           const email= $('#email').val();
           const phone= $('#phone').val();
           const password= $('#password').val();
           const company_id= $('#company').val();
           const status= $('#status').val();


           if(name===''){
               errors.name='Name is required!'
               valid=false
           }

            if (email === ''){
                errors.email= 'email is required!'
                valid=false;
            }else if(!/^\S+@\S+\.\S+$/.test(email))
            {
                errors.email='Invalid email address!';
                valid=false;
            }


            if(phone ===''){
                errors.phone='Phone is required!'
                valid=false;
            } else if(phone.length >12)
            {
                errors.phone='Phone number must be less then 12 characters'

                valid=false;
            }

            const passwordPattern=/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]$/;
            if(password===''){
                errors.password='Password is required!'
                valid=false;
            }else if(password.length < 8){
                errors.password='Password must have at least 8 character long'
                valid=false;
            }
            // else if(!passwordPattern.test(password)){
            //     errors.password='Password must include one capital letter, one special character, and one number'
            //     valid=false;
            //
            // }
            if (status === '') {
                errors.status = 'Status is required.';
                valid = false;
            } else if (!['active', 'inactive'].includes(status)) {
                errors.status = 'Status must be either active or inactive.';
                valid = false;
            }

            if(company_id===''){
                errors.company='Please the Company'
            }

            if(!valid){
                showErrors(errors)
            }else{
                clearErrors();
            }

            return valid

        }


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
                        alert('Error fetching companies:'+ error.setText);

                    }
                });
            });
            $('#name, #email, #phone,#password, #status, #company').on('input change', function () {
                validateForm();
            });
            $('#saveEmployeeBtn').click(async function(e){
                e.preventDefault()

                $(this).prop('disabled', true)

                const valid=validateForm();
                if(!valid){
                    $(this).prop('disabled', false)
                    return;

                }

                const file = document.getElementById('profile').files[0];




                  const onComplete = async (profile) =>{

                    let data = {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        password: $('#password').val(),
                        profile_img: profile,
                        company_id: $('#company').val(),
                        status: $('#status').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }
                    // console.log(data);

                    $.ajax({
                        url: '{{ route("employees.create") }}',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            console.log(response);
                            $('#addEmployeeModal').modal('hide');
                            location.reload()

                        },
                        error: function (error) {
                            if (error.responseJSON && error.responseJSON.errors) {
                            showErrors(error.responseJSON.errors);
                            } else {
                            alert('An error occurred: ' + error.statusText);
                            }

                        }
                    })


                  };
                if(file){
                    $('#create-progress-container').show();

                    function updateProgress(progress) {
                        const progressBar = document.getElementById('create-progress-bar');

                        progressBar.style.width = progress + '%';
                        progressBar.setAttribute('aria-valuenow', progress);
                        progressBar.innerText = Math.round(progress) + '%';
                    }
                  await handleFileUpload(file, onComplete,updateProgress)
                }else{
                    await onComplete(null)

                }

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
                        // Set profile image with fallback
                        const defaultProfileImg = 'https://firebasestorage.googleapis.com/v0/b/employee-management-4cde8.appspot.com/o/alt%20images%2Fuser_icon_001.jpg?alt=media&token=6e12626e-f597-4c50-8834-0fc25c8acb3a';
                        const profileImgSrc = employee.profile_img ? employee.profile_img : defaultProfileImg;
                        $('#view-profile').attr('src', profileImgSrc);
                        $('#view-status').text(employee.status ? 'Active' : 'Inactive');
                    },
                    error: function (error) {
                        alert('Error fetching employee details:'+ error.setText);
                    }
                });
            });
            let employeeIdToDelete;

            $('.delete-btn').on('click', function() {
                employeeIdToDelete = $(this).data('id');
                $('#confirmDeleteModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                $(this).prop('disabled', true)
                $.ajax({
                    url: '{{ url('employees/delete') }}/' + employeeIdToDelete,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Remove the row from the table
                        $('#employee-' + employeeIdToDelete).remove();
                        $('#confirmDeleteModal').modal('hide');
                        location.reload();
                    },
                    error: function(error) {
                        // Handle the error
                        alert('An error occurred while deleting the employee: ' + error.responseText);
                        $('#confirmDeleteModal').modal('hide');
                    }
                });
            });
            $('#updateEmployeeModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); // Button that triggered the modal
                const employeeId = button.data('id'); // Extract info from data-* attributes

                $.ajax({
                    url: '{{ route('employees.getUpdate', '') }}/' + employeeId,
                    type: 'GET',
                    success: function (response) {
                        const employee = response.employee;
                        const companies = response.companies;

                        $('#update-employee-id').val(employee.id);
                        $('#update-name').val(employee.name);
                        $('#update-email').val(employee.email);
                        $('#update-phone').val(employee.phone);
                        $('#update-password').val(employee.password);
                        // Set profile image with fallback
                        const defaultProfileImg = 'https://firebasestorage.googleapis.com/v0/b/employee-management-4cde8.appspot.com/o/alt%20images%2Fuser_icon_001.jpg?alt=media&token=6e12626e-f597-4c50-8834-0fc25c8acb3a';
                        const profileImgSrc = employee.profile_img ? employee.profile_img : defaultProfileImg;
                        $('#update-profile-img').attr('src', profileImgSrc);

                        $('#update-company').empty().append('<option value="">Select Company</option>');
                        if(employee.status===0){
                            $('#update-status').val('inactive');

                        }else{
                            $('#update-status').val('active');
                        }

                        $.each(companies, function(index, company) {
                            $('#update-company').append(
                                $('<option>', {
                                    value: company.id,
                                    text: company.name,
                                    selected: employee.company_id === company.id ? 'selected' : ''
                                })
                            );
                        });
                    },
                    error: function (error) {
                        alert('Error fetching employee details for update:'+ error.setText);
                    }
                });
            });
            $('#updateEmployeeBtn').click( async function () {
                $(this).prop('disabled', true)

                var id = $('#update-employee-id').val();
                var profile_img= '{{$employee->profile_img}}';
                var name = $('#update-name').val();
                var email =$('#update-email').val();
                var phone = $('#update-phone').val();
                var company = $('#update-company').val();

                // var allowed_email = $('').val();
                var  status = $('#update-status').val() === 'active' ? 1 : 0;


                let newProfile=$('#update-profile')[0].files[0];
                if(newProfile){
                    $('#update-progress-container').show();

                    function updateProgress(progress) {
                        const progressBar = document.getElementById('update-progress-bar');
                        if(!progressBar){
                            alert('bar not found')
                        }
                        progressBar.style.width = progress + '%';
                        progressBar.setAttribute('aria-valuenow', progress);
                        progressBar.innerText = Math.round(progress) + '%';
                    }


                        const file = newProfile;

                        const onComplete=async (Profile)=> {

                            let data = {
                                profile_img: Profile,
                                name: name,
                                email: email,
                                phone: phone,
                                company_id: company,
                                status: status,
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                _method: 'PATCH'
                            }
                            $.ajax({
                                url: `{{ url('employees/update') }}/${id}`,
                                method: 'POST',
                                data: data,
                                success: function (response) {
                                    console.log(response)
                                    $('#updateEmployeeModal').modal('hide');
                                    location.reload();

                                },
                                error: function (error) {
                                    if (error.responseJSON && error.responseJSON.errors) {
                                        showErrors(error.responseJSON.errors);
                                    } else {
                                        alert('An error occurred: ' + error.statusText);
                                    }
                                }

                            })

                        }
                        handleFileUpload(file, onComplete,updateProgress)


                }else{
                    let data={
                        profile_img: profile_img,
                        name:name,
                        email:email,
                        company_id:company,
                        phone:phone,
                        status:status,
                        _token : $('meta[name="csrf-token"]').attr('content'),
                        _method:'PATCH'

                    }
                    $.ajax({
                        url:`{{ url('employees/update') }}/${id}` ,
                        method:"POST",
                        data:data,
                        success:function (response) {
                            console.log(response);
                            $('#updateEmployeeModal').modal('hide');
                            location.reload();
                        },
                        error:function (error) {
                            if (error.responseJSON && error.responseJSON.errors) {
                                showErrors(error.responseJSON.errors);
                            } else {
                                alert('An error occurred: ' + error.statusText);
                            }

                        }
                    })
                }


            })



        });

    </script>
@endsection
