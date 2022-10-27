<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}

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

</x-app-layout>
