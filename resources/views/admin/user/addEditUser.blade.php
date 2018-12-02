@extends('admin.layouts.app')
@section('content')

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->

            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form role="form" name="addEditUser" id="addEditUser" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body col-md-12">
                            <input type="hidden" name="userId" value="{{ (!empty($user_info->id))?($user_info->id):('') }}">
                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ (!empty($user_info->name))?($user_info->name):('') }}">
                                    @if ($errors->has('name'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}
                                    </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6" >
                                    <label for="exampleInputEmail">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{ (!empty($user_info->email))?($user_info->email):('') }}">
                                    @if ($errors->has('email'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('email') }}
                                    </p>  
                                    @endif
                                </div>
                            </div>
                           
                            <!-- <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" value="">
                                    @if ($errors->has('password'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i>  {{ $errors->first('password') }}
                                    </p>
                                    @endif
                                </div>
                            
                                <div class="form-group col-md-6 ">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" value="" >
                                    @if ($errors->has('confirm_password'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i>  {{ $errors->first('confirm_password') }}
                                    </p>
                                    @endif
                                </div>
                            </div> -->
                          
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Enter mobile number" value="{{ (!empty($user_info->mobile_number))?($user_info->mobile_number):('') }}">
                                    @if ($errors->has('mobile_number'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('mobile_number') }}
                                    </p>  
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail">Address</label>
                                    <input type="text" class="form-control" name="address" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" value="{{ (!empty($user_info->address))?($user_info->address):('') }}">
                                    @if ($errors->has('address'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('address') }}
                                    </p> 
                                    @endif
                                </div>
                                 <input type="hidden" name="latitude" id="latitude" value="{{ (!empty($user_info->latitude))?($user_info->latitude):('') }}" class="form-control" placeholder="Laitude">
                                <input type="hidden" name="longitude" id="longitude" value="{{ (!empty($user_info->longitude))?($user_info->longitude):('') }}" class="form-control" placeholder="Longitude">
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Country Name</label>
                                    <select name="country_id" id="country_id"  data-table="{{ encode('state') }}" onchange="getChangeData('', 'country_id', 'state_id', 'Select State', 'city_id', 'Select City')" class="form-control select2" style="width: 100%;">
                                        <option value="">Select a Country</option>  
                                        @if(count($all_country) > 0)   
                                        @foreach($all_country as $country)
                                        <option value="{{ $country->id }}" <?php echo (!empty($user_info))?( ($user_info->country_id == $country->id)?('selected'):('') ):('') ?> >{{ $country->name }}</option>  
                                        @endforeach
                                        @endif 
                                    </select>
                                    @if ($errors->has('country_id'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('country_id') }}
                                    </p> 
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>State Name</label>
                                    <select name="state_id" id="state_id"  data-table="{{ encode('city') }}" onchange="getChangeData('', 'state_id', 'city_id', 'Select City')"  
                                    class="form-control select2" style="width: 100%;">
                                        <option value="">Select a State</option>  
                                        
                                    </select>
                                    @if ($errors->has('state_id'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('state_id') }}
                                    </p> 
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>city Name</label>
                                    <select name="city_id" id="city_id" class="form-control select2" style="width: 100%;">
                                        <option value="">Select a city</option>  
                                        
                                    </select>
                                    @if ($errors->has('city_id'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('city_id') }}
                                    </p> 
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail">Phone Code</label>
                                    <input type="text" class="form-control" name="phone_code" id="phone_code" placeholder="Enter Phone Code" value="{{ (!empty($user_info->phone_code))?($user_info->phone_code):('') }}">
                                    @if ($errors->has('phone_code'))
                                    <p class="error">
                                        <i class="fa fa-times-circle-o"></i> {{ $errors->first('phone_code') }}
                                    </p>  
                                    @endif
                                </div>
                                
                            </div>
                            <div class="form-group col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-4">
                                            @if (!empty($user_info->image))
                                            <img id="blah" src="{{ asset('public/'.$user_info->image) }}" class="" width="100" height="80"/>
                                            @else
                                            <?php $NoImage = asset('public/admin_profile/no_image.png'); ?>
                                            <img id="blah" src="{{ url($NoImage) }}" width="70" height="70" alt="Image">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-8">
                                            <!-- hidden  old_path when update  -->
                                            <input type="hidden" name="old_path" id="old_path" value="{{ (!empty($user_info->image))?($user_info->image):('') }}">
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
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>  
</section>  
@endsection

@section('js')

<script> 
    

     $(window).on('load',function() {

        var cityId = '<?php echo (!empty($user_info->city_id))?($user_info->city_id):(''); ?>'; 
        var stateId =  '<?php echo (!empty($user_info->state_id))?($user_info->state_id):(''); ?>';
        if(stateId != ''){

            getChangeData(stateId, 'country_id', 'state_id', 'Select State', 'city_id', 'Select City');
        }

        if(cityId != ''){
            setTimeout(function () {
               getChangeData(cityId, 'state_id', 'city_id', 'Select City');
            }, 1000);
            
        }
    });

     function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }
      
      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        //console.log(place.formatted_address);
        $('#latitude').val(parseFloat(place.geometry.location.lat().toFixed(10)));
        $('#longitude').val(parseFloat(place.geometry.location.lng().toFixed(10)));
        //console.log(place.geometry.location.lat());
        //console.log(place.geometry.location.lng());
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
      
   
    </script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnwZwVgjkb3spc9YbluPmfxQM8diUEclU&libraries=places&callback=initAutocomplete"></script>
@endsection