@extends('admin.layouts.app')
@section('content')

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title">Edit Profile</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" name="update-profile" id="update-profile" action="{{ url('admin/post-profile') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body col-md-6 col-md-offset-3">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ auth()->user()->name }}">
                            @if($errors->has('name'))
                            <p class="error">
                                <i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}
                            </p>  
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ auth()->user()->email }}">
                            @if ($errors->has('email'))
                            <p class="error">
                                <i class="fa fa-times-circle-o"></i> {{ $errors->first('email') }}
                            </p>  
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail">Mobile Number</label>
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Enter mobile number" value="{{ auth()->user()->mobile_number }}">
                            @if ($errors->has('mobile_number'))
                            <p class="error">
                                <i class="fa fa-times-circle-o"></i> {{ $errors->first('mobile_number') }}
                            </p>  
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-4">
                                        @if (!empty(auth()->user()->image))
                                        <img id="blah" src="{{ asset('public/admin_profile/'.auth()->user()->image) }}" class="" width="100" height="80"/>
                                        @else
                                        <?php $NoImage = asset('public/admin_profile/no_image.png'); ?>
                                        <img id="blah" src="{{ url($NoImage) }}" width="70" height="70" alt="Image">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-8">
                                        <!-- hidden  old_path when update  -->
                                        <input type="hidden" name="old_path" id="old_path" value="{{ auth()->user()->image }}">
                                        <h5>Image<span class="text-danger">*</span></h5>

                                        <input type="file" onchange="readURL(this);" name="image" >

                                        <p class="help-block">Max file size 2MB.</p>
                                        <em><strong>Note :</strong> Please use transparent PNG image for better resolution. </em>

                                    </div> 
                                    @if ($errors->has('image'))
                                    <p class="error help-block">{{ $errors->first('image') }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>  
</section>  

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title">Change Password</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" name="change-password" id="change-password" action="{{ url('admin/change-password') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body col-md-6 col-md-offset-3">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                @if ($errors->has('password'))
                                <p class="error">
                                    <i class="fa fa-times-circle-o"></i> {{ $errors->first('password') }}
                                </p>  
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter New password">
                                @if ($errors->has('new_password'))
                                <p class="error">
                                    <i class="fa fa-times-circle-o"></i> {{ $errors->first('new_password') }}
                                </p>  
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter confirm password">
                                @if ($errors->has('confirm_password'))
                                <p class="error">
                                    <i class="fa fa-times-circle-o"></i> {{ $errors->first('confirm_password') }}
                                </p>  
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</section>   
@endsection