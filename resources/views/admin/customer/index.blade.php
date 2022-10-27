@extends('layouts.app')

@section ('title')
    Users
@endsection


@section ('header')
    Users List
@endsection

@section('content')


    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row">
                            <div class="col-xl-10 col-lg-10 col-sm-10">
                                <h3>Users List</h3>
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-2 text-right">
                                {{-- <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                    Add User
                                </button> --}}
                            </div>
                        </div>

                        <div class="table-responsive mb-4 mt-4">
                             <table id="default-ordering" class="table table-hover" style="width:100%">
                            <!-- <table id="zero-config" class="table table-hover" style="width:100%"> -->
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->

    <!-- Modal Start-->
    <div class="modal fade register-modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" id="registerModalLabel">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('user.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>{{ __('Forename') }}</label>
                            <input id="name" type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name" value="{{ old('f_name') }}" required autocomplete="f_name" autofocus>
                            @error('f_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Surname') }}</label>
                            <input id="name" type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name" value="{{ old('l_name') }}" required autocomplete="l_name" autofocus>
                            @error('l_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" >{{ __('E-Mail Address') }}</label>
                                <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="number" >{{ __('Number') }}</label><br>
                            <input  type="tel" id="number" class="form-control" name="number"  required autocomplete="number">
                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                                <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                       <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input  type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="submit" class="btn btn-primary  btn-block" name="submit" value="Save">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Model Ended -->

    <!-- Update Modal Start-->
    <div class="modal fade register-modal" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" id="registerModalLabel">
                    <h4 class="modal-title">Update User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>

                <div class="modal-body">

                    <form id="form_update" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>{{ __('Forename') }}</label>
                            <input id="f_name" type="text" class="form-control" name="f_name">
                            <input type="hidden" id="id" class="form-control" name="id">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Surname') }}</label>
                            <input id="l_name" type="text" class="form-control" name="l_name">

                        </div>
                        <div class="form-group">
                            <label>{{ __('E-Mail Address') }}</label>
                                <input id="email" type="text" class="form-control" name="email" readonly>
                        </div>
                        {{-- <div class="form-group">
                            <label>{{ __('Number') }}</label>
                            <input id="number" type="text" class="form-control" name="number">
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>{{ __('Contact') }}</label>
                            <input id="contact" type="text" class="form-control" name="contact">
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" >
                        </div> --}}
                        <div class="form-group">
                            <label></label>
                            <input type="button" onclick="UpdateUser()"  class="btn btn-primary  btn-block" value="Update">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- Update Model Ended -->


@endsection
@section('javascript')

    <script>
        function StatusUpdate(id){
            $.ajax({
                url : '{{route("user.status")}}',
                data: {
                    "_token": "{{csrf_token()}}",
                    id      : id,
                },
                type   : "POST",
                success: function(data){
                    $('#default-ordering').DataTable().ajax.reload();
                    Snackbar.show({
                        text           : 'Status Update Successfully',
                        pos            : 'top-right',
                        backgroundColor: '#1B55E2'
                    });
                },

                error: function(error){
                    Snackbar.show({
                        text           : 'Somthing Went Wrong',
                        pos            : 'top-right',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                }
            });
        }


        function UserModal(id){
            $.ajax({
                url : '{{route("user.modal")}}',
                data: {
                    "_token": "{{csrf_token()}}",
                    id      : id,
                },
                type   : "POST",
                success: function(data){
                    $("#UserModal").modal('show');
                    $("#f_name").val(data.f_name);
                    $("#l_name").val(data.l_name);
                    $("#id").val(data.id);
                    $("#email").val(data.email);
                    // $("#number").val(data.number);
                    // $("#contact").val(data.contact);
                    // $("#password").val(data.password);

                },
                error: function(error){
                    Snackbar.show({
                        text           : 'Somthing Went Wrong',
                        pos            : 'top-right',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                }
            });
        }

        function UpdateUser(){

            var formdata = $('#form_update').serialize();
            $.ajax({
                type   : "POST",
                url    : '{{route("user.update")}}',
                data   : formdata,
                success: function(data){
                    $('#UserModal').modal('hide');
                    $('#default-ordering').DataTable().ajax.reload();
                    Snackbar.show({
                        text           : 'User Updated Successfully',
                        pos            : 'top-right',
                        backgroundColor: '#1B55E2'
                    });
                },
                error: function (error){
                    Snackbar.show({
                        text           : 'Somthing Went Wrong',
                        pos            : 'top-right',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                }
            });
        }



        function UserDelete(id) {
            swal.fire({
                title             : "Are you sure?",
                text              : "You will not be able to recover this imaginary file!",
                type              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : "Yes, delete it!",
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        type: "GET",
                        url : '{{url("user/delete")}}/' + id,

                        success: function(data){
                        $('#default-ordering').DataTable().ajax.reload();
                        swal.fire("Success", " User delted successfully", "success");
                        },
                            error: function (error){
                            Snackbar.show({
                                text           : 'Selected User has purchased Subscription please remove it first',
                                pos            : 'top-right',
                                actionTextColor: '#fff',
                                backgroundColor: '#e7515a'
                            });
                        }
                    });
                }else {
                    Swal.fire('User not deleted', '', 'info')
                }
            });
        }


    </script>


    <script type="text/javascript">
         $(function() {

            table = $('#default-ordering').DataTable( {
                // processing: true,
                // serverSide: true,
                // autoWidth: true,
                // responsive: true,
                // "bInfo": true ,
                ajax: "{{ route('user.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions' }
                ],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
                },

                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7,

            } );
        });
    </script>

<script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });
 </script>



@endsection
