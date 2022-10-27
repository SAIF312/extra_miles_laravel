@extends('admin.layouts.app')

@section ('title')
    Dashboard
@endsection


@section ('header')
    Dashboard Admin List
@endsection

@section('content')


    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-sm-9">
                                <h3>Dashboard Admin  List</h3>
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
                            <div class="col-xl-3 col-lg-3 col-sm-3 text-right">
                                <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                    Add Dashboard Admin
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive mb-4 mt-4">
                             <table id="default-ordering" class="table table-hover" style="width:100%">

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
                    <h4 class="modal-title">Add Dashboard Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('dashboard.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>{{ __('Forename') }}</label>
                            <input id="name" type="text" class="form-control @error('forename') is-invalid @enderror" name="forename" value="{{ old('forename') }}" required autocomplete="name" autofocus>
                            @error('forename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">{{ __('Surname') }}</label>
                            <input id="name" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="name" autofocus>
                            @error('surname')
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
                        <div class="form-group">
                            <label for="contact" >{{ __('Contact') }}</label>
                                <input  type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact">
                                @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
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
    <div class="modal fade register-modal" id="CustomerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" id="registerModalLabel">
                    <h4 class="modal-title">Update Dashboard Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>

                <div class="modal-body">

                    <form id="form_update" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>{{ __('Forename') }}</label>
                            <input id="forename" type="text" class="form-control" name="forename">
                            <input type="hidden" id="id" class="form-control" name="id">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Surname') }}</label>
                            <input id="surname" type="text" class="form-control" name="surname">

                        </div>
                        <div class="form-group">
                            <label>{{ __('E-Mail Address') }}</label>
                                <input id="email" type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Contact') }}</label>
                                <input id="contact" type="text" class="form-control" name="contact">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" >
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="button" onclick="UpdateCustomer()"  class="btn btn-primary  btn-block" value="Update">
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
                url:'{{url("customer/status")}}',
                data: {
                    "_token"    :"{{csrf_token()}}",
                    id:id,
                },
                type: "POST",
                success: function(data){
                    $('#default-ordering').DataTable().ajax.reload();
                    // var val = data.status
                    // var html = '';
                    // if(val == "Active"){
                    //     html = "<span class='btn badge badge-info'>Active</span>";
                    // }else{
                    //     html = "<span class='btn badge badge-danger'>Disabled</span>";
                    // }
                    // document.getElementById(id).innerHTML=html;

                    Snackbar.show({
                        text           : 'Status Update Successfully',
                        pos            : 'top-right',
                        backgroundColor: '#1B55E2'
                    });
                },

                error: function(error){
                    Snackbar.show({
                        text: 'Somthing Went Wrong',
                        pos: 'top-right',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                }
            });
        }


        function CustomerModal(id){
            $.ajax({
                url:'{{url("customer/modal")}}',
                data:    {
                    "_token"    :"{{csrf_token()}}",
                    id:id,
                },
                type: "POST",
                success: function(data){
                    $("#CustomerModal").modal('show');
                    $("#forename").val(data.forename);
                    $("#surname").val(data.surname);
                    $("#id").val(data.id);
                    $("#email").val(data.email);
                    $("#contact").val(data.contact);
                    $("#password").val(data.password);

                },
                error: function(error){
                    Snackbar.show({
                        text: 'Somthing Went Wrong',
                        pos: 'top-right',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                }
            });
        }

        function UpdateCustomer(){

            var formdata = $('#form_update').serialize();
            // console.log(formdata);
            // return false;
            $.ajax({
                type : "POST",
                url:'{{url("customer/update")}}',
                data: formdata,
                success: function(data){
                    $('#CustomerModal').modal('hide');
                    $('#default-ordering').DataTable().ajax.reload();
                    Snackbar.show({
                        text           : 'Dashboard Admin Updated Successfully',
                        pos            : 'top-right',
                        backgroundColor: '#1B55E2'
                    });
                },
                error: function (error){
                    Snackbar.show({
                        text: 'Somthing Went Wrong',
                        pos: 'top-right',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                }
            });
        }

// function zustomerDelete(id){

// $.ajax({
//     type : "GET",

//     url:'{{url("delete_user")}}/' + id,

//     success: function(data){
//         $('#default-ordering').DataTable().ajax.reload();
//         Snackbar.show({
//             text           : 'Usere Deleted Successfully',
//             pos            : 'top-right',
//             backgroundColor: '#1B55E2'
//         });
//     },
//     error: function (error){
//         Snackbar.show({
//             text: 'Somthing Went Wrong',
//             pos: 'top-right',
//             actionTextColor: '#fff',
//             backgroundColor: '#e7515a'
//         });
//     }
// });
// }

function Delete(id) {
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        //  console.log(isConfirm);
        if(result.isConfirmed){
        $.ajax({
        type : "GET",
        url:'{{url("dashboard/delete")}}/' + id,

        success: function(data){
        $('#default-ordering').DataTable().ajax.reload();
        swal.fire("Success", " Dashboard admin delted successfully", "success");
    },
         error: function (error){
        Snackbar.show({
            text: 'Somthing Went Wrong',
            pos: 'top-right',
            actionTextColor: '#fff',
            backgroundColor: '#e7515a'
        });
    }
});
        }
        else {
    Swal.fire('Dashboard Admin not deleted', '', 'info')
  }
    });
}


    </script>


    <script type="text/javascript">
         $(function() {

            table = $('#default-ordering').DataTable( {

                ajax: "{{ route('dashboard.index') }}",
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




@endsection
