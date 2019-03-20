@extends('layouts.backend.app')
@section('title','Settings')
@push('css')
@endpush
@section('content')
<div class="container-fluid">
<!-- Tabs With Icon Title -->
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                SETTINGS
            </h2>                         
        </div>
        <div class="body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#profile_with_icon_title" data-toggle="tab">
                        <i class="material-icons">face</i> PROFILE
                    </a>
                </li>
                <li role="presentation">
                    <a href="#change_pasword_with_icon_title" data-toggle="tab">
                        <i class="material-icons">change_history</i> Change Password 
                    </a>
                </li>                               
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.profile.update')}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name address" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address_2">Email Address</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="email_address_2" class="form-control" placeholder="Enter your email address" name="email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="Profile_Image">Profile Image</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" name="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="About">About</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="5" name="about" class="form-control">{{ Auth::user()->about }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>                              

                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="change_pasword_with_icon_title">
                    <form  class="form-horizontal" method="POST" action="{{ route('admin.password.update')}}">
                        @csrf
                        @method('PUT')
                        <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="old_password">Old Password</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter your Old password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password">New Password</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your New password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="confirm_password">Confirm Password</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="confirm_password" name="password_confirmation" class="form-control" placeholder="Enter your Confirm password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE PASSWORD</button>
                            </div>
                        </div>
                    </form>                                

                </div>
            </div>                                
        </div>
    </div>
</div>
</div>
</div>
<!-- #END# Tabs With Icon Title -->
</div>
@endsection   

@push('js')



@endpush
