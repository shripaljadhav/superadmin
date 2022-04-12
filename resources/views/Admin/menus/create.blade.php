@extends('layouts.admin')
@section('title', 'Add Menu')

@section('content')
<style>
.selectgroup-pills .selectgroup-item{flex-grow: 1!important;    margin-right: 0!important;}
.selectgroup-pills input:checked+span{border-radius: 0px !important;}.selectgroup-pills .selectgroup-button {
    border-radius: 0px !important;
}
</style>
<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'menus/store', 'name'=>"add-learning", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Add Menu</h4>
						</div>
						<div class="card-body">
							
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" data-valid="required" class="form-control"/>
								@if ($errors->has('name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('name') }}</strong>
									</span> 
								@endif
							</div>
							<div class="form-group">
								<label for="name">Description</label>
								
								<textarea class="form-control" name="des" data-valid="required"></textarea>
								@if ($errors->has('des'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('des') }}</strong>
									</span> 
								@endif
							</div>
							 <div class="" style="padding: 5px 10px 0px 20px;margin-bottom: 24px;border-radius: 4px;border: 2px solid rgb(224, 224, 224);">
							 <div class="form-group">
							 <label class="form-label">Menu Hours</label>
							 <div class="selectgroup selectgroup-pills">
								  
								  <div class="selectgroup w-100">
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[0][]" value="0" class="selectgroup-input">
									  <span class="selectgroup-button">Mon</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[0][]" value="1" class="selectgroup-input">
									  <span class="selectgroup-button">Tue</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[0][]" value="2" class="selectgroup-input">
									  <span class="selectgroup-button">Wed</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[0][]" value="3" class="selectgroup-input">
									  <span class="selectgroup-button">Thu</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[0][]" value="4" class="selectgroup-input">
									  <span class="selectgroup-button">Fri</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[0][]" value="5" class="selectgroup-input">
									  <span class="selectgroup-button">Sat</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[0][]" value="6" class="selectgroup-input">
									  <span class="selectgroup-button">Sun</span>
									</label>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6">
								 <div class="form-group">
								 <label>Start Time</label>
									<select class="form-control" name="start_time[0][]">
										 <option selected="" value="00:00">12.00 AM</option>
										<option value="00:30">12.30 AM</option>
										<option value="01:00">01.00 AM</option>
										<option value="01:30">01.30 AM</option>
										<option value="02:00">02.00 AM</option>
										<option value="02:30">02.30 AM</option>
										<option value="03:00">03.00 AM</option>
										<option value="03:30">03.30 AM</option>
										<option value="04:00">04.00 AM</option>
										<option value="04:30">04.30 AM</option>
										<option value="05:00">05.00 AM</option>
										<option value="05:30">05.30 AM</option>
										<option value="06:00">06.00 AM</option>
										<option value="06:30">06.30 AM</option>
										<option value="07:00">07.00 AM</option>
										<option value="07:30">07.30 AM</option>
										<option value="08:00">08.00 AM</option>
										<option value="08:30">08.30 AM</option>
										<option value="09:00">09.00 AM</option>
										<option value="09:30">09.30 AM</option>
										<option value="10:00">10.00 AM</option>
										<option value="10:30">10.30 AM</option>
										<option value="11:00">11.00 AM</option>
										<option value="11:30">11.30 AM</option>
										<option value="12:00">12.00 PM</option>
										<option value="12:30">12.30 PM</option>
										<option value="13:00">01.00 PM</option>
										<option value="13:30">01.30 PM</option>
										<option value="14:00">02.00 PM</option>
										<option value="14:30">02.30 PM</option>
										<option value="15:00">03.00 PM</option>
										<option value="15:30">03.30 PM</option>
										<option value="16:00">04.00 PM</option>
										<option value="16:30">04.30 PM</option>
										<option value="17:00">05.00 PM</option>
										<option value="17:30">05.30 PM</option>
										<option value="18:00">06.00 PM</option>
										<option value="18:30">06.30 PM</option>
										<option value="19:00" >07.00 PM</option>
										<option value="19:30">07.30 PM</option>
										<option value="20:00">08.00 PM</option>
										<option value="20:30">08.30 PM</option>
										<option value="21:00">09.00 PM</option>
										<option value="21:30">09.30 PM</option>
										<option value="22:00">10.00 PM</option>
										<option value="22:30">10.30 PM</option>
										<option value="23:00">11.00 PM</option>
										<option value="23:30">11.30 PM</option>
									</select>
								</div>
								</div>
								<div class="col-md-6">
								 <div class="form-group">
								 <label>Start Time</label>
									<select class="form-control" name="end_time[0][]">
										 <option selected="" value="00:00">12.00 AM</option>
										<option value="00:30">12.30 AM</option>
										<option value="01:00">01.00 AM</option>
										<option value="01:30">01.30 AM</option>
										<option value="02:00">02.00 AM</option>
										<option value="02:30">02.30 AM</option>
										<option value="03:00">03.00 AM</option>
										<option value="03:30">03.30 AM</option>
										<option value="04:00">04.00 AM</option>
										<option value="04:30">04.30 AM</option>
										<option value="05:00">05.00 AM</option>
										<option value="05:30">05.30 AM</option>
										<option value="06:00">06.00 AM</option>
										<option value="06:30">06.30 AM</option>
										<option value="07:00">07.00 AM</option>
										<option value="07:30">07.30 AM</option>
										<option value="08:00">08.00 AM</option>
										<option value="08:30">08.30 AM</option>
										<option value="09:00">09.00 AM</option>
										<option value="09:30">09.30 AM</option>
										<option value="10:00">10.00 AM</option>
										<option value="10:30">10.30 AM</option>
										<option value="11:00">11.00 AM</option>
										<option value="11:30">11.30 AM</option>
										<option value="12:00">12.00 PM</option>
										<option value="12:30">12.30 PM</option>
										<option value="13:00">01.00 PM</option>
										<option value="13:30">01.30 PM</option>
										<option value="14:00">02.00 PM</option>
										<option value="14:30">02.30 PM</option>
										<option value="15:00">03.00 PM</option>
										<option value="15:30">03.30 PM</option>
										<option value="16:00">04.00 PM</option>
										<option value="16:30">04.30 PM</option>
										<option value="17:00">05.00 PM</option>
										<option value="17:30">05.30 PM</option>
										<option value="18:00">06.00 PM</option>
										<option value="18:30">06.30 PM</option>
										<option value="19:00">07.00 PM</option>
										<option value="19:30">07.30 PM</option>
										<option value="20:00">08.00 PM</option>
										<option value="20:30">08.30 PM</option>
										<option value="21:00">09.00 PM</option>
										<option value="21:30">09.30 PM</option>
										<option value="22:00">10.00 PM</option>
										<option value="22:30">10.30 PM</option>
										<option value="23:00">11.00 PM</option>
										<option value="23:30">11.30 PM</option>
									</select>
								</div>
								</div>
							</div>
                    </div>	
					<div class="more_hours"></div>
					<div class="form-group">
						<a href="javascript:;" class="add_more_hours">Add More Days and Time</a>
					</div>
						</div> 
					</div>
				</div>
				<div class="col-3 col-md-3 col-lg-3">
					<div class="card">
						
						<div class="card-footer"> 
							<a style="margin-right:5px;" href="{{route('admin.menus.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
							<button type="button" onClick="customValidate('add-learning')" class="btn btn-success pull-right">Save</button>
						</div>
					</div>
					
				</div> 
            </div>
			{{ Form::close() }}
		</div>
	</section> 
</div>
<div class="morhoursdata" style="display:none;">
 <div class="mydiv" style="padding: 5px 10px 0px 20px;margin-bottom: 24px;border-radius: 4px;border: 2px solid rgb(224, 224, 224);">
							 <div class="form-group">
							 <label class="form-label">Menu Hours</label>
							 <div class="selectgroup selectgroup-pills">
								  
								  <div class="selectgroup w-100">
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[]" value="0" class="selectgroup-input menuh">
									  <span class="selectgroup-button">Mon</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[]" value="1" class="selectgroup-input menuh">
									  <span class="selectgroup-button">Tue</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[]" value="2" class="selectgroup-input menuh">
									  <span class="selectgroup-button">Wed</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[]" value="3" class="selectgroup-input menuh">
									  <span class="selectgroup-button">Thu</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[]" value="4" class="selectgroup-input menuh">
									  <span class="selectgroup-button">Fri</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[]" value="5" class="selectgroup-input menuh">
									  <span class="selectgroup-button">Sat</span>
									</label>
									<label class="selectgroup-item">
									  <input type="checkbox" name="menu_hour[]" value="6" class="selectgroup-input menuh">
									  <span class="selectgroup-button">Sun</span>
									</label>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6">
								 <div class="form-group">
								 <label>Start Time</label>
									<select class="form-control strtime" name="start_time[]">
										 <option selected="" value="00:00">12.00 AM</option>
										<option value="00:30">12.30 AM</option>
										<option value="01:00">01.00 AM</option>
										<option value="01:30">01.30 AM</option>
										<option value="02:00">02.00 AM</option>
										<option value="02:30">02.30 AM</option>
										<option value="03:00">03.00 AM</option>
										<option value="03:30">03.30 AM</option>
										<option value="04:00">04.00 AM</option>
										<option value="04:30">04.30 AM</option>
										<option value="05:00">05.00 AM</option>
										<option value="05:30">05.30 AM</option>
										<option value="06:00">06.00 AM</option>
										<option value="06:30">06.30 AM</option>
										<option value="07:00">07.00 AM</option>
										<option value="07:30">07.30 AM</option>
										<option value="08:00">08.00 AM</option>
										<option value="08:30">08.30 AM</option>
										<option value="09:00">09.00 AM</option>
										<option value="09:30">09.30 AM</option>
										<option value="10:00">10.00 AM</option>
										<option value="10:30">10.30 AM</option>
										<option value="11:00">11.00 AM</option>
										<option value="11:30">11.30 AM</option>
										<option value="12:00">12.00 PM</option>
										<option value="12:30">12.30 PM</option>
										<option value="13:00">01.00 PM</option>
										<option value="13:30">01.30 PM</option>
										<option value="14:00">02.00 PM</option>
										<option value="14:30">02.30 PM</option>
										<option value="15:00">03.00 PM</option>
										<option value="15:30">03.30 PM</option>
										<option value="16:00">04.00 PM</option>
										<option value="16:30">04.30 PM</option>
										<option value="17:00">05.00 PM</option>
										<option value="17:30">05.30 PM</option>
										<option value="18:00">06.00 PM</option>
										<option value="18:30">06.30 PM</option>
										<option value="19:00" >07.00 PM</option>
										<option value="19:30">07.30 PM</option>
										<option value="20:00">08.00 PM</option>
										<option value="20:30">08.30 PM</option>
										<option value="21:00">09.00 PM</option>
										<option value="21:30">09.30 PM</option>
										<option value="22:00">10.00 PM</option>
										<option value="22:30">10.30 PM</option>
										<option value="23:00">11.00 PM</option>
										<option value="23:30">11.30 PM</option>
									</select>
								</div>
								</div>
								<div class="col-md-6">
								 <div class="form-group">
								 <label>Start Time</label>
									<select class="form-control endtime" name="end_time[]">
										 <option selected="" value="00:00">12.00 AM</option>
										<option value="00:30">12.30 AM</option>
										<option value="01:00">01.00 AM</option>
										<option value="01:30">01.30 AM</option>
										<option value="02:00">02.00 AM</option>
										<option value="02:30">02.30 AM</option>
										<option value="03:00">03.00 AM</option>
										<option value="03:30">03.30 AM</option>
										<option value="04:00">04.00 AM</option>
										<option value="04:30">04.30 AM</option>
										<option value="05:00">05.00 AM</option>
										<option value="05:30">05.30 AM</option>
										<option value="06:00">06.00 AM</option>
										<option value="06:30">06.30 AM</option>
										<option value="07:00">07.00 AM</option>
										<option value="07:30">07.30 AM</option>
										<option value="08:00">08.00 AM</option>
										<option value="08:30">08.30 AM</option>
										<option value="09:00">09.00 AM</option>
										<option value="09:30">09.30 AM</option>
										<option value="10:00">10.00 AM</option>
										<option value="10:30">10.30 AM</option>
										<option value="11:00">11.00 AM</option>
										<option value="11:30">11.30 AM</option>
										<option value="12:00">12.00 PM</option>
										<option value="12:30">12.30 PM</option>
										<option value="13:00">01.00 PM</option>
										<option value="13:30">01.30 PM</option>
										<option value="14:00">02.00 PM</option>
										<option value="14:30">02.30 PM</option>
										<option value="15:00">03.00 PM</option>
										<option value="15:30">03.30 PM</option>
										<option value="16:00">04.00 PM</option>
										<option value="16:30">04.30 PM</option>
										<option value="17:00">05.00 PM</option>
										<option value="17:30">05.30 PM</option>
										<option value="18:00">06.00 PM</option>
										<option value="18:30">06.30 PM</option>
										<option value="19:00">07.00 PM</option>
										<option value="19:30">07.30 PM</option>
										<option value="20:00">08.00 PM</option>
										<option value="20:30">08.30 PM</option>
										<option value="21:00">09.00 PM</option>
										<option value="21:30">09.30 PM</option>
										<option value="22:00">10.00 PM</option>
										<option value="22:30">10.30 PM</option>
										<option value="23:00">11.00 PM</option>
										<option value="23:30">11.30 PM</option>
									</select>
								</div>
								</div>
							</div>
                    </div>	
</div>
@endsection
@section('scripts')
<script>
$(function() {
   
	$(document).delegate('.add_more_hours', 'click', function(){
		
		
		$('.more_hours').append($('.morhoursdata').html());
		
		changename();
	});
	function changename(){
		var more_hours = 1;
		$('.more_hours .mydiv').each(function(){
			$(this).find('.menuh').attr('name', 'menu_hour['+more_hours+'][]');
			$(this).find('.endtime').attr('name', 'end_time['+more_hours+'][]');
			$(this).find('.strtime').attr('name', 'start_time['+more_hours+'][]');
			more_hours++;
		})
	}
	$(document).delegate('.remove_item', 'click', function(){
		$(this).parent().parent().parent().remove();
	});
});
</script>
@endsection