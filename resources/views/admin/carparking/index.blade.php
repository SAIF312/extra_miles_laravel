@extends('admin.layouts.app')

@section ('title')
    Car Parking Rates
@endsection


@section ('header')
    Rate List
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
                                <h3>Rate List</h3>
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
                            <!-- <div class="col-xl-3 col-lg-3 col-sm-3 text-right">
                                <button type="button" class="btn btn-primary mb-2 mr-3" data-toggle="modal" data-target="#registerModal">
                                    Add Fuel Price
                                </button>
                            </div> -->
                        </div>

                        <div class="table-responsive mb-4 mt-4">
                             <table id="default-ordering" class="table table-hover" style="width:100%">

                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <!-- <th>Latitude</th>
                                        <th>Longitude</th> -->
                                        <th>Goto location</th>
                                        <th>Date</th>
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




    <div class="modal fade register-modal bd-example-modal-lg" id="CarParkingModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header" id="registerModalLabel">
                    <h4 class="modal-title">Car Parking Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <div class="modal-body">
                <div class="table-responsive mb-4 mt-4">
                             <table id="default-ordering_days" class="table table-hover" style="width:100%">

                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Days</th>
                                        <th>Timing</th>
                                        <th>Price</th>
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





@endsection
@section('javascript')

    <!-- <script>
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


    </script> -->


    <script type="text/javascript">
         $(function() {

           table = $('#default-ordering').DataTable( {

                ajax: "{{ route('carparking.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'location', name: 'location' },
                    { data: 'created_at', name: 'created_at' },
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

function CarParkingModal(id){
    $("#CarParkingModal").modal('show');
    // alert(id);

    if ( $.fn.DataTable.isDataTable( '#default-ordering_days' ) ) {
        table1.destroy();
    }
    table1 = $('#default-ordering_days').DataTable( {

            ajax: '{{ url("admin/carparking/modal")}}/'+id,
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'days', name: 'days' },
                { data: 'timing', name: 'timing' },
                { data: 'price', name: 'price' },
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

}


</script>

@endsection
