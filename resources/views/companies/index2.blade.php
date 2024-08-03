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
{{--                                    <th>LOGO</th>--}}
                                    <th>Website</th>
                                    <th>Phone</th>
                                    <th>Address</th>
{{--                                    <th>Password</th>--}}
{{--                                    <th>Screenshot time</th>--}}
                                    <th>No. OF Employees</th>
{{--                                    <th>Allowed Email</th>--}}
{{--                                    <th>Status</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)
                                    <tr id="company-{{$company->id}}">
                                        <td>{{ $company->id }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
{{--                                        <td>{{ $company->logo }}</td>--}}
                                        <td>{{ $company->website }}</td>
                                        <td>{{ $company->phone }}</td>
                                        <td>{{ $company->address }}</td>
{{--                                        <td>{{ $company->password }}</td>--}}
{{--                                        <td>{{ $company->screenshot_time }}</td>--}}
                                        <td>{{ $company->no_of_employees }}</td>
{{--                                        <td>{{ $company->allowed_email }}</td>--}}
{{--                                        <td>{{ $company->status }}</td>--}}
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#companyModal" data-action="view" data-id="{{ $company->id }}">View</button>
                                            <button type="button" class="btn btn-primary btn-sm m-1" data-toggle="modal" data-target="#updateCompanyModal" data-action="update" data-id="{{ $company->id }}">Update</button>
                                            <button type="button" class="btn btn-danger btn-sm mx-1 delete-btn" data-company-id="{{ $company->id }}">{{ __('Delete') }}</button>
{{--                                            <button type="button" class="btn btn-danger btn-sm m-1" data-id="{{ $company->id }}" onclick="deleteCompany({{ $company->id }})">Delete</button>--}}
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="companyModalLabel">View Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group text-center">
                        <img id="view-logo" class="img-thumbnail rounded" style="max-width: 150px;" src="" alt="Logo">
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
                        <label for="view-website">Website</label>
                        <p id="view-website"></p>
                    </div>
                    <div class="form-group">
                        <label for="view-phone">Phone</label>
                        <p id="view-phone"></p>
                    </div>
                    <div class="form-group">
                        <label for="view-address">Address</label>
                        <p id="view-address"></p>
                    </div>
                    <div class="form-group">
                        <label for="view-password">Password</label>
                        <p id="view-password"></p>
                    </div>
                    <div class="form-group">
                        <label for="view-screenshot_time">Screenshot Time</label>
                        <p id="view-screenshot_time"></p>
                    </div>
                    <div class="form-group">
                        <label for="view-no_of_employees">No. Of Employees</label>
                        <p id="view-no_of_employees"></p>
                    </div>
                    <div class="form-group">
                        <label for="view-allowed_email">Allowed Email</label>
                        <p id="view-allowed_email"></p>
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

    <!-- Update Company Modal -->
    <!-- Update Company Modal -->
    <div class="modal fade" id="updateCompanyModal" tabindex="-1" role="dialog" aria-labelledby="updateCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="updateCompanyModalLabel">Update Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateCompanyForm" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="hidden" id="update-company-id" name="id">


                        <div class="form-group text-center">
                            <img id="update-logo" class="img-thumbnail rounded" style="max-width: 150px;" src="" alt="Logo">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="update-name">Name</label>
                                <input type="text" class="form-control" id="update-name" name="name" placeholder="Name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="update-email">Email</label>
                                <input type="email" class="form-control" id="update-email" name="email" placeholder="Email" required>
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
                                <label for="update-password">Password</label>
                                <input type="password" class="form-control" id="update-password" name="password" placeholder="Password" disabled>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="update-allowed_email">Allowed Email</label>
                                <input type="text" class="form-control" id="update-allowed_email" name="allowed_email" placeholder="Allowed Email">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="update-status">Status</label>
                                <select class="form-control" id="update-status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="update-logo-input">New Logo (optional)</label>
                            <input type="file" class="form-control" id="update-logo-input" name="logo">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateCompanyBtn">Save Changes</button>
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

            // function updateProgress(progress) {
            //     // console.log(progressId)
            //     const progressBar = document.getElementById('create-progress-bar');
            //     console.log('barr'+progressBar)
            //     // if (!progressBar) {
            //     //     console.error('Progress bar element not found:', progressId);
            //     //     return;
            //     // }
            //     progressBar.style.width = progress + '%';
            //     progressBar.setAttribute('aria-valuenow', progress);
            //     progressBar.innerText = Math.round(progress) + '%';
            // }

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

        $(document).ready(function (){
                $('#saveCompanyBtn').click( async function (e) {
                    e.preventDefault()

                    const file=$('#logo')[0].files[0]

                    if(file){
                        $('#create-progress-container').show();
                        function updateProgress(progress) {
                            const progressBar = document.getElementById('create-progress-bar');
                            console.log(progressBar)

                            progressBar.style.width = progress + '%';
                            progressBar.setAttribute('aria-valuenow', progress);
                            progressBar.innerText = Math.round(progress) + '%';
                        }
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
                    // let containerID=document.getElementById('create-progress-container')'
                       await handleFileUpload(file, onComplete, updateProgress)
                    }else{
                        const data = {

                            name: $('#name').val(),
                            email: $('#email').val(),
                            phone: $('#phone').val(),
                            address: $('#address').val(),
                            website: $('#website').val(),
                            password: $('#password').val(),
                            allowed_email: $('#allowed_email').val(),
                            status: $('#status').val(),

                            _token: $('meta[name="csrf-token"]').attr('content')

                        }

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
                                console.log(error)
                                if (error.responseJSON && error.responseJSON.errors) {
                                    showErrors(error.responseJSON.errors);
                                } else {
                                    alert('An error occurred: ' + error.statusText);
                                }
                            }
                        });

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

                            if (response.company.status === 0) {
                                $('#view-status').val('inactive');
                            } else {
                                $('#view-status').val('active');
                            }
                        },
                        error: function (error) {
                            alert('error in fetching data'+error.setText);
                        }
                    });
                }
            });
            $('.delete-btn').on('click', function () {
                let companyId=$(this).data('company-id')
                if(confirm('Are you sure you want to delete the company?')){
                    $.ajax({
                        url:'/companies/delete/' + companyId,
                        method:"DELETE",
                        data:{
                            _token: '{{csrf_token()}}'
                        },
                        success: function (response) {
                            // console.log(response);
                        //     remove the row from table
                            $('Company-', companyId).remove();
                            location.reload()

                        },
                        error:function (error) {
                            alert('error in deleting the company'+ error.setText)

                        }

                    })
                }

            })
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
                    var password = $('#update-password').val();
                    var allowed_email = $('#update-allowed_email').val();
                   var  status = $('#update-status').val() === 'active' ? 1 : 0;


                   let newLogo=$('#update-logo-input')[0].files[0];
                   if(newLogo){
                       $('#create-progress-container').show();
                       function updateProgress(progress) {
                           const progressBar = document.getElementById('create-progress-bar');
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
