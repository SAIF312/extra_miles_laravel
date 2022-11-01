@extends('admin.layouts.app')

@section ('title')
    Customers
@endsection


@section ('header')
    Profile
@endsection

@section('content')

@include('sweetalert::alert')

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-spacing">

            <!-- Content -->
            <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                <div class="user-profile layout-spacing" style="width:100%;">
                    <div class="widget-content widget-content-area">
                        <div class="d-flex justify-content-between">
                            <h3 class="">Profile</h3>
                            <a  class="mt-2 edit-profile" data-bs-toggle="modal" data-bs-target="#registerModal" style="cursor:pointer;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                        </div>
                        <div class="text-center user-info">
                        <img src="{{asset(!is_null(auth()->user()->profile_img_url)?auth()->user()->profile_img_url:'assets/assets/img/profile.jpg')}}" alt="avatar" style="border-radius: 50%; height:150px; width:150px; padding:1px; background-color:black;">
                            <p class="" style="font-size:30px;">{{auth()->user()->name}}</p>
                        </div>
                        <div class="user-info-list">

                            <div class="">
                                <ul class="contacts-block list-unstyled">
                                    <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> Admin
                                    </li>
                                    {{-- <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>{{auth()->user()->dob}}
                                    </li> --}}

                                    <li class="contacts-block__item">
                                        <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{auth()->user()->email}}</a>
                                    </li>
                                    {{-- <li class="contacts-block__item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>{{auth()->user()->contact}}
                                    </li> --}}

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#password" style="margin-top:20px;">
                                        Change Account Password
                                    </button>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>




            </div>



        </div>
    </div>

</div>
<!--  END CONTENT AREA  -->
</div>
    <!--  END CONTENT AREA  -->



    <!-- Update Modal Start-->
    <div class="modal fade register-modal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" id="registerModalLabel">
                    <h4 class="modal-title">Update Profile</h4>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>

                <div class="modal-body">

                    <form action="{{route('profile.update')}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <!-- <div class="form-group">
                            <label>{{ __('Forename') }}</label>
                            <input id="forename" type="text" class="form-control" name="f_name" value="{{auth()->user()->f_name}}">
                            <input type="hidden" id="id" class="form-control" name="id" value="{{auth()->id()}}">
                        </div> -->
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input id="surname" type="text" class="form-control" name="name" value="{{auth()->user()->name}}">

                        </div>
                        <!-- <div class="form-group">
                            <label>{{ __('E-Mail Address') }}</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{auth()->user()->email}}">
                        </div> -->

                      <div class="form-group">
                            <label>{{ __('Image') }}</label>
                                <input id="image" type="file" class="form-control" name="image" >
                        </div>
                        <div class="form-group">
                            <label></label>
                            <button type="submit"   class="btn btn-primary  btn-block" value="Update">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- Update Model Ended -->

   <!-- Button trigger modal -->

<!-- password Modal -->
<div class="modal fade" id="password" tabindex="-1" aria-labelledby="passwordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Password Update</h5>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">

      <form action="{{route('profile.updatePassword')}}" method="POST">
      {{csrf_field()}}
      <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Current Password</label>
    <input type="password" class="form-control" name="old_password" id="exampleInputEmail1" aria-describedby="emailHelp">
</div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Password</label>
    <input type="password" class="form-control" name="new_password" id="exampleInputEmail1" aria-describedby="emailHelp">
    <input type="hidden" id="id" class="form-control" name="id" value="{{auth()->id()}}">
</div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1">
  </div>
  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
  <button type="submit"   class="btn btn-primary" value="Update">Change Password</button>

</form>

      </div>

    </div>
  </div>
</div>


@endsection
@section('javascript')

 <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


@endsection
