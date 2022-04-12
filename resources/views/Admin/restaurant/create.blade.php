@extends('layouts.admin')
@section('title', 'Create Company')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'restaurant/store', 'name'=>"add-company", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			
			 <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}" readonly required>
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}" readonly required>
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-12 col-md-8 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Restaurant Info</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group">
								<label>Restaurant Name</label>
								<input autocomplete="off" type="text" name="restaurant_name" data-valid="required" class="form-control"/>
								@if ($errors->has('restaurant_name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('restaurant_name') }}</strong>
									</span> 
								@endif
							</div>
							
							<div class="form-group">
								<label>Restaurant Phone No.</label>
								<input autocomplete="new-password" type="text" name="phone" data-valid="required" class="form-control"/>
								@if ($errors->has('phone'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('phone') }}</strong>
									</span> 
								@endif
							</div>
							
							<div class="form-group">
								<label>Cuisine 1</label>
								<select class="form-control" name="cuisine_1">
									<option value=""></option>
									@foreach(\App\Cuisine::all() as $clist)
										<option value="{{$clist->id}}">{{$clist->title}}</option>
									@endforeach
								</select>
								
							</div>
							<div class="form-group">
								<label>Cuisine 2</label>
								<select class="form-control" name="cuisine_2">
									<option value=""></option>
									@foreach(\App\Cuisine::all() as $clist2)
										<option value="{{$clist2->id}}">{{$clist2->title}}</option>
									@endforeach
								</select>
								
							</div>
							<div class="form-group">
								<label>Cuisine 3</label>
								<select class="form-control" name="cuisine_3">
									<option value=""></option>
									@foreach(\App\Cuisine::all() as $clist3)
										<option value="{{$clist3->id}}">{{$clist3->title}}</option>
									@endforeach
								</select>
								
							</div>
							 <div class="form-group">
							  <label>Website Url</label>
							  <div class="input-group">
								<div class="input-group-prepend">
								  <div class="input-group-text">
									https://
								  </div>
								</div>
								<input autocomplete="off" type="text" name="company_website" data-valid="required" class="form-control"/>
								@if ($errors->has('company_website'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('company_website') }}</strong>
									</span> 
								@endif
							  </div>
							</div>
							
						</div>
					</div>
					
					<div class="card">
						<div class="card-header"> 
							<h4>Address Information</h4>
						</div> 
						<div class="card-body"> 
							<div class="form-group{{ $errors->has('maps_address') ? ' has-error' : '' }}">
								<label for="maps_address">Location</label>
								<input tabindex="2" id="pac-input" class="form-control controls" type="text" placeholder="Enter Shop Location" name="maps_address" value="{{ old('maps_address') }}">
							</div>
							<div class="form-group">
								<label>Address 1</label>
								<input autocomplete="new-password" type="text" data-valid="required" name="address_1" id="address" class="form-control"/>
								@if ($errors->has('address_1'))
								<span class="custom-error" role="alert">
								<strong>{{ @$errors->first('address_1') }}</strong>
								</span> 
								@endif
							</div>	
                                <div id="map" style="height:400px;"></div>
							
							
							<div class="form-group">
								<label>Zip Code</label>
								<input autocomplete="new-password" id="zipcode" type="text" data-valid="required" name="zipcode" class="form-control"/>
								@if ($errors->has('zipcode'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('zipcode') }}</strong>
									</span> 
								@endif
							</div>
							
							
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Contact Information</h4>
						</div> 
						<div class="card-body"> 
							<div class="row">
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Primary Contact Name</label>
										<input autocomplete="new-password" type="text" name="contact_name" data-valid="required" class="form-control"/>
										@if ($errors->has('contact_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('contact_name') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Primary Contact Phone</label>
										<input autocomplete="new-password" type="text" name="contact_phone" data-valid="required" class="form-control"/>
										@if ($errors->has('contact_phone'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('contact_phone') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Primary Contact Email</label>
										<input autocomplete="new-password" type="text" name="contact_email" data-valid="required email" class="form-control"/>
										@if ($errors->has('contact_email'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('contact_email') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Password</label>
										<input autocomplete="new-password" type="password" name="password" data-valid="required" class="form-control"/>
										@if ($errors->has('password'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('password') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-6 col-md-6 col-lg-6">
									<div class="form-group">
										<label>Best Time to Contact</label>
										<textarea autocomplete="new-password" class="form-control" name="best_time_contact"></textarea>
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Order Payment</h4>
						</div>
						<div class="card-body"> 
							<div class="row">
								<div class="col-md-6">
									<label>Who pays the $1.50 convenience fee?</label>
								</div>
								<div class="col-md-6">
									<ul>
										<li><label><input type="radio" value="restaurant" name="who_pay_fee"> Restaurant</label></li>
										<li><label><input type="radio" value="customers" name="who_pay_fee"> Customers</label></li>
										<li>	<label><input value="customers_if_order_larger" type="radio" name="who_pay_fee"> Customers, unless the order is larger than</label></li>
										<li>%<input type="text" name="custome_order_large_pric" value="0"></li>
									</ul>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									<label>Sales Tax Rate (%)</label>
									<input autocomplete="new-password" type="text" value="0" name="sale_tax" placeholder="%" class="form-control"/>
									</div>
								</div>
							</div>
						</div>
						</div>
						
						<div class="card">
							<div class="card-header"> 
								<h4>Delivery Information</h4>
							</div>
							<div class="card-body"> 
								<div class="row">
									<div class="col-md-12">
										<label><input type="checkbox" value="1" name="res_deliver" id="res_deliver"> Does restaurant deliver?</label></li>
									</div>
									<div class="col-md-12 is_deliver" style="display:none;">
										<div class="form-group">
											<label>Delivery Notes (Optional)</label>
											<input autocomplete="new-password" type="text" value="" name="delivery_note" placehoder="" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
				<div class="col-12 col-md-4 col-lg-3">
					<div class="card">
						<div class="card-header"> 
							<h4>Publish</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="1">Publish</option>
									<option value="0">Draft</option>
								</select>
							</div>
						</div> 
						<div class="card-footer"> 
							<button type="button" onClick="customValidate('add-company')" class="btn btn-success pull-right">Submit</button>
						</div>
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Logo</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Logo</label>
								<input type="file" name="logo_img" class="form-control" />
							</div>
						</div> 
					</div>
					<div class="card">
						<div class="card-header"> 
							<h4>Image</h4>
						</div>
						<div class="card-body"> 
							<div class="form-group" style="margin-bottom:0px;">
								<label>Image</label>
								<input type="file" name="profile_img" class="form-control" />
							</div>
						</div> 
					</div>
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>

@endsection
@section('scripts')
<script>
jQuery(document).ready(function($){
	$('#res_deliver').on('click', function(){
		if($('#res_deliver').is(':checked')){
			$('.is_deliver').show();
		}else{
			$('.is_deliver').hide();
		}
	});
});
</script>
<script>
    var map;
    var input = document.getElementById('pac-input');
    var latitude = document.getElementById('latitude');
    var longitude = document.getElementById('longitude');
    var address = document.getElementById('address');
    var zipcode = document.getElementById('zipcode');

    function initMap() {

        var userLocation = new google.maps.LatLng(
                13.0796758,
                80.2696968
            );

        map = new google.maps.Map(document.getElementById('map'), {
            center: userLocation,
            zoom: 15
        });

        var service = new google.maps.places.PlacesService(map);
        var autocomplete = new google.maps.places.Autocomplete(input);
        var infowindow = new google.maps.InfoWindow();

        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow({
            content: "Shop Location",
        });

        var marker = new google.maps.Marker({
            map: map,
            draggable: true,
            anchorPoint: new google.maps.Point(0, -29)
        });

        marker.setVisible(true);
        marker.setPosition(userLocation);
        infowindow.open(map, marker);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(location) {
                var userLocation = new google.maps.LatLng(
                    location.coords.latitude,
                    location.coords.longitude
                );
                marker.setPosition(userLocation);
                map.setCenter(userLocation);
                map.setZoom(13);
            });
        }

        google.maps.event.addListener(map, 'click', updateMarker);
        google.maps.event.addListener(marker, 'dragend', updateMarker);

        function updateMarker(event) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': event.latLng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        input.value = results[0].formatted_address;
						console.log(results);
                        updateForm(event.latLng.lat(), event.latLng.lng(), results[0].formatted_address);
                    } else {
                        alert('No Address Found');
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });

            marker.setPosition(event.latLng);
            map.setCenter(event.latLng);
        }

        autocomplete.addListener('place_changed', function(event) {
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            if (place.hasOwnProperty('place_id')) {
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }
				console.log(place);
                updateLocation(place.geometry.location);
				for (var i = 0; i < place.address_components.length; i++) {
					
					 var types = place.address_components[i].types;
					 for (var typeIdx = 0; typeIdx < types.length; typeIdx++) {
						if (types[typeIdx] == 'postal_code') {
							//console.log(results[0].address_components[i].long_name);

							var pincode = place.address_components[i].short_name;
							zipcode.value = pincode;

						}
					}
				}
            } else {
                service.textSearch({
                    query: place.name
                }, function(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
						console.log(results);
                        updateLocation(results[0].geometry.location, results[0].formatted_address);
                        input.value = results[0].formatted_address;
                    }
                });
            }
        });

        function updateLocation(location) {
            map.setCenter(location);
            marker.setPosition(location);
            marker.setVisible(true);
            infowindow.open(map, marker);
            updateForm(location.lat(), location.lng(), input.value);
        }

        function updateForm(lat, lng, addr) {
            console.log(lat,lng, addr);
            latitude.value = lat;
            longitude.value = lng;
            address.value = addr;
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiaY76XFe_UOYq9MBi0_h2v-TtNRyaR5g&libraries=places&callback=initMap" async defer></script>
@endsection