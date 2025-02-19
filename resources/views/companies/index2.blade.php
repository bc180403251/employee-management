@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Companies') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addCompanyModal">
                        {{ __('Add Company') }}
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
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">

                            <table class="table-list  table table-bordered table-striped table-hover maximized-card" style="max-width: 100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>No. OF Employees</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)
                                    <tr id="company-{{$company->id}}">
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->website }}</td>
                                        <td>{{ $company->phone }}</td>
                                        <td>{{ $company->address }}</td>
                                        <td>{{ $company->no_of_employees }}</td>
                                        <td>
                                            <div class="d-flex flex-row text-center">
                                               <button type="button" class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#companyModal" data-action="view" data-id="{{ $company->id }}">View</button>
                                               <button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#updateCompanyModal" data-action="update" data-id="{{ $company->id }}">Update</button>
                                               <button type="button" class="btn btn-danger btn-sm m-1 delete-btn" data-company-id="{{ $company->id }}">{{ __('Delete') }}</button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $companies->links() }}
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <div class="modal fade   " id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="addCompanyModalLabel">Add New Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCompanyForm" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" placeholder="Website URL">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allowed_email">Allowed Email(OPTIONAL)</label>
                                    <input type="text" class="form-control" id="allowed_email" name="allowed_email" placeholder="Allowed Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo(OPTIONAL)</label>
                            <input type="file" class="form-control" id="logo" name="logo" placeholder="Logo URL" required>
                        </div>
                    </form>
                </div>
                <div id="create-progress-container" class="progress mx-3" style="display: none;">
                    <div id="create-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveCompanyBtn">Add Company</button>
                </div>
            </div>
        </div>
    </div>


    <!-- View Company Modal -->
    <div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="companyModalLabel">View Company</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <!-- Content area on the left -->
                        <div class="flex-grow-1">
                            <div class="form-group">
                                <label for="view-name">Name</label>
                                <p id="view-name" class="form-control-plaintext"></p>
                            </div>
                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="view-email">Email</label>
                                <p id="view-email" class="form-control-plaintext"></p>
                            </div>
                            <!-- Additional fields -->
                            <div class="row mt-lg-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view-website">Website</label>
                                        <p id="view-website" class="form-control-plaintext"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view-phone">Phone</label>
                                        <p id="view-phone" class="form-control-plaintext"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view-address">Address</label>
                                        <p id="view-address" class="form-control-plaintext"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view-screenshot_time">Screenshot Time</label>
                                        <p id="view-screenshot_time" class="form-control-plaintext"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view-no_of_employees">No. Of Employees</label>
                                        <p id="view-no_of_employees" class="form-control-plaintext"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view-allowed_email">Allowed Email</label>
                                        <p id="view-allowed_email" class="form-control-plaintext"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view-status">Status</label>
                                        <p id="view-status" class="form-control-plaintext"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Image on the right top -->
                        <div class="d-flex flex-column align-items-center" style="position: relative">
                            <img id="view-logo" class="img-thumbnail rounded" style="max-width: 150px; position: absolute; top: 0; right: 0; margin-right: 50px", src="" alt="Logo">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <!-- Update Company Modal -->
    <div class="modal fade" id="updateCompanyModal" tabindex="-1" role="dialog" aria-labelledby="updateCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="updateCompanyModalLabel">Update Company</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateCompanyForm" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="hidden" id="update-company-id" name="id">

                        <div class="d-flex align-items-start">
                            <!-- Text Fields Area (Top Left and Top Right) -->
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

                            <!-- Image Area (Right Side) -->
                            <div class="ml-3">
                                <div class="form-group text-center">
                                    <img id="update-logo" class="img-thumbnail rounded" style="max-width: 200px; margin-right: 35px" src="" alt="Logo">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="update-website">Website</label>
                                <input type="text" class="form-control" id="update-website" name="website" placeholder="Website URL">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="update-phone">Phone</label>
                                <input type="text" class="form-control" id="update-phone" name="phone" placeholder="Phone">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="update-address">Address</label>
                                <input type="text" class="form-control" id="update-address" name="address" placeholder="Address">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="update-allowed_email">Allowed Email</label>
                                <input type="text" class="form-control" id="update-allowed_email" name="allowed_email" placeholder="Allowed Email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="update-status">Status</label>
                                <select class="form-control" id="update-status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="update-logo-input">New Logo (optional)</label>
                                <input type="file" class="form-control" id="update-logo-input" name="logo">
                            </div>
                        </div>


                    </form>
                </div>
                <div id="update-progress-container" class="progress mx-3" style="display: none;">
                    <div id="update-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updateCompanyBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this company?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>




    <!-- jQuery -->
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
            // console.log(containerId)

            const storageRef = ref(storage, 'companies/logos/' + file.name);
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

        function validateForm() {
            let valid=true;
            let errors={};

            const name = $('#name').val().trim();
            const email = $('#email').val().trim();
            const website = $('#website').val().trim();
            const phone = $('#phone').val().trim();
            const address = $('#address').val().trim();
            const password = $('#password').val().trim();
            const allowed_email = $('#allowed_email').val().trim();
            const status = $('#status').val().trim();

            // validation
            if(name ===''){
                errors.name='name is required!'
                valid=false;

            }

            if (email === ''){
                errors.email= 'email is required!'
                valid=false;
            }else if(!/^\S+@\S+\.\S+$/.test(email))
            {
                errors.email='Invalid email address!';
                valid=false;
            }

            if(website===''){
                errors.website='Website is required!'
                valid=false;
            }

            // const phonePattern= /^(\+92|0)?[3][0-9]{9}$/;9
            if(phone ===''){
                errors.phone='Phone is required!'
                valid=false;
            } else if(phone.length >12)
            {
                errors.phone='Phone number must be less then 12 characters '

                valid=false;
            }

            if(address ===''){
                errors.address='Address is required!'
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

            if(allowed_email && !!/^\S+@\S+\.\S+$/.test(allowed_email)){
                errors.allowed_email='If provided, Allowed email must be valid  email address!'
                valid=false
            }

            if (status === '') {
                errors.status = 'Status is required.';
                valid = false;
            } else if (!['active', 'inactive'].includes(status)) {
                errors.status = 'Status must be either active or inactive.';
                valid = false;
            }

            // display the errors if any
            if(!valid){
                showErrors(errors)
            }else{
                clearErrors();
            }

            return valid

        }

        $(document).ready(function (){
            $('#name, #email, #website, #phone, #address, #password, #allowed_email, #status').on('input change', function () {
                validateForm();
            });
                $('#saveCompanyBtn').click( async function (e) {
                    e.preventDefault()

                    const valid=validateForm();
                    if(!valid){
                        return
                    }
                    const file=$('#logo')[0].files[0]


                     const onComplete=async (logo)=> {


                        const data = {

                            name: $('#name').val(),
                            email: $('#email').val(),
                            phone: $('#phone').val(),
                            address: $('#address').val(),
                            website: $('#website').val(),
                            password: $('#password').val(),
                            allowed_email: $('#allowed_email').val(),
                            status: $('#status').val(),
                            logo: logo,
                            _token: $('meta[name="csrf-token"]').attr('content')

                        }
                        // console.log(data)
                        $.ajax({
                            url: '{{ route("companies.create") }}',
                            type: 'POST',
                            data: data,
                            success: function (response) {
                                // console.log(response);
                                $('#addCompanyModal').modal('hide');
                                location.reload()

                            },
                            error: function (error) {
                                if (error.responseJSON && error.responseJSON.errors) {
                                    showErrors(error.responseJSON.errors);
                                } else {
                                    alert('An error occurred: ' + error.statusText);
                                }
                            }
                        });

                      }
                    if(file){
                        $('#create-progress-container').show();
                        function updateProgress(progress) {
                            const progressBar = document.getElementById('create-progress-bar');
                            console.log(progressBar)

                            progressBar.style.width = progress + '%';
                            progressBar.setAttribute('aria-valuenow', progress);
                            progressBar.innerText = Math.round(progress) + '%';
                        }
                    // let containerID=document.getElementById('create-progress-container')'
                       await handleFileUpload(file, onComplete, updateProgress)
                    }else{
                       await onComplete(null)

                    }

                });


            $('#companyModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var action = button.data('action');
                var id = button.data('id');

                if (action === 'view') {
                    $.ajax({
                        url: '{{ url('companies/show') }}/' + id,
                        type: 'GET',
                        success: function (response) {
                            console.log(response)
                            $('#view-name').text(response.company.name);
                            $('#view-email').text(response.company.email);
                            $('#view-website').text(response.company.website);
                            $('#view-phone').text(response.company.phone);
                            $('#view-address').text(response.company.address);
                            $('#view-password').text(response.company.password);
                            $('#view-screenshot_time').text(response.company.screenshot_time);
                            $('#view-no_of_employees').text(response.company.no_of_employees);
                            $('#view-allowed_email').text(response.company.allowed_email);
                            // $('#view-status').text(response.company.status);
                            $('#view-logo').attr('src', response.company.logo);

                            let status= response.company.status


                            if (status === 0) {
                                $('#view-status').text('Inactive');
                            } else {
                                $('#view-status').text('Active');
                            }
                        },
                        error: function (error) {
                            alert('error in fetching data'+error.setText);
                        }
                    });
                }
            });
            let companyIdToDelete = null;

            // Show the delete confirmation modal and store the company ID
            $('.delete-btn').on('click', function () {
                companyIdToDelete = $(this).data('company-id');
                $('#deleteConfirmationModal').modal('show');
            });

            // Confirm delete action
            $('#confirmDeleteBtn').on('click', function () {
                if (companyIdToDelete !== null) {
                    $.ajax({
                        url: '/companies/delete/' + companyIdToDelete,
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            // Remove the row from the table
                            $('#Company-' + companyIdToDelete).remove();
                            $('#deleteConfirmationModal').modal('hide');
                            location.reload();
                            // Optionally, you might want to update the table or page content here
                        },
                        error: function (error) {
                            alert('Error in deleting the company: ' + error.statusText);
                        }
                    });
                }
            });
            $('#updateCompanyModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                // var action = button.data('action');
                var id = button.data('id');

                $.ajax({
                    url: '{{ url("companies/update") }}/' + id,
                    type: 'GET',
                    success: function (response) {
                        $('#update-company-id').val(response.company.id);
                        $('#update-name').val(response.company.name);
                        $('#update-email').val(response.company.email);
                        $('#update-website').val(response.company.website);
                        $('#update-phone').val(response.company.phone);
                        $('#update-address').val(response.company.address);
                        $('#update-password').val(response.company.password);
                        $('#update-allowed_email').val(response.company.allowed_email);
                        // $('#update-status').val(response.company.status);
                        $('#update-logo').attr('src', response.company.logo); // Default if no logo

                        // Set status based on response
                        if (response.company.status === 0) {
                            $('#update-status').val('inactive');
                        } else {
                            $('#update-status').val('active');
                        }
                    },
                    error: function (error) {
                        alert('error in  getting data'+error.setText);
                    }
                });
            });

        //     handle Patch request
            $('#updateCompanyBtn').click( async function () {

                var id = $('#update-company-id').val();
                     var logo= '{{$company->logo}}';
                    var name = $('#update-name').val();
                    var email =$('#update-email').val();
                    var phone = $('#update-phone').val();
                    var address = $('#update-address').val();
                   var  website = $('#update-website').val();
                    var allowed_email = $('#update-allowed_email').val();
                   var  status = $('#update-status').val() === 'active' ? 1 : 0;


                   let newLogo=$('#update-logo-input')[0].files[0];
                   if(newLogo){
                       $('#update-progress-container').show();
                       function updateProgress(progress) {
                           const progressBar = document.getElementById('update-progress-bar');
                           console.log(progressBar)

                           progressBar.style.width = progress + '%';
                           progressBar.setAttribute('aria-valuenow', progress);
                           progressBar.innerText = Math.round(progress) + '%';
                       }


                       const file = newLogo;

                          const onComplete= async (logo)=> {


                               let data={

                                   name:name,
                                   email:email,
                                   address:address,
                                   phone:phone,
                                   website:website,
                                   allowed_email:allowed_email,
                                   status:status,
                                   logo: logo,
                                   _token : $('meta[name="csrf-token"]').attr('content'),
                                   _method:'PATCH'
                               }
                               $.ajax({
                                   url:`{{ url('companies/update') }}/${id}`,
                                   method:'POST',
                                   data:data,
                                   success:function (response) {
                                       // console.log(response)
                                       $('#updateCompanyModal').modal('hide');
                                       location.reload();

                                   },
                                   error: function (error){
                                       if (error.responseJSON && error.responseJSON.errors) {
                                           showErrors(error.responseJSON.errors);
                                       } else {
                                           alert('An error occurred: ' + error.statusText);
                                       }
                                   }

                               })
                           };

                         await handleFileUpload(file, onComplete, updateProgress)

                   }else{
                       let data={

                           name:name,
                           email:email,
                           address:address,
                           phone:phone,
                           website:website,
                           allowed_email:allowed_email,
                           status:status,
                           logo: logo,
                           _token : $('meta[name="csrf-token"]').attr('content'),
                           _method:'PATCH'

                       }
                       $.ajax({
                           url:`{{ url('companies/update') }}/${id}` ,
                           method:"POST",
                           data:data,
                           success:function (response) {
                               console.log(response);
                               $('#updateCompanyModal').modal('hide');
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
