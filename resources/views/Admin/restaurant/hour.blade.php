@extends('layouts.admin')
@section('title', 'Buisness Hour')

@section('content')
<style>
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.05);
}
.hours .closed {
    color: red;
    font-weight: bold;
}
</style>
<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'restaurant/hourstore', 'name'=>"add-company", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			
			 <input type="hidden" id="res_id" value="{{ $fetchedData->id }}" readonly required>
             
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Buisness Hour</h4>
						</div>
						<div class="card-body"> 
							<table id="hours-table" class="hours table table-striped">
										<tbody>
										<?php
										$query1 = \App\Hour::where('day', 'Sunday')->where('hour_type', 'business')->where('user_id', $fetchedData->id);
										$sundayBcount = $query1->count();
										$sundayBdata = $query1->get();
										?>
											<tr>
												<td>Sunday</td>
												<?php
													if($sundayBcount !== 0){
													?>
													<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Sunday">
														<?php foreach($sundayBdata as $sundayBdatas){ ?>
														<div class="hour-row text-nowrap" data-hourid="<?php echo base64_encode(convert_uuencode(@$sundayBdatas->id)); ?>" data-opentime24="<?php echo $sundayBdatas->opentime; ?>" data-closetime24="<?php echo $sundayBdatas->closetime; ?>">
															<span><?php echo date('h:i A', strtotime($sundayBdatas->opentime)); ?></span>&nbsp;to&nbsp;<span><?php echo date('h:i A', strtotime($sundayBdatas->closetime)); ?></span>
															<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>
															<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>
														</div>
														<?php } ?>
													</td>
													<?php }else{
														?>
														<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Sunday"><span class="closed">Closed</span></td>
														<?php
													} ?>
												
												<td><a href="javascript:;" class="add-hours">Add Hours</a></td>
											</tr>
											<?php
										$query1 = \App\Hour::where('day', 'Monday')->where('hour_type', 'business')->where('user_id', $fetchedData->id);
										$MondayBcount = $query1->count();
										$MondayBdata = $query1->get();
										?>
											<tr>
												<td>Monday</td>
												<?php
													if($MondayBcount !== 0){
													?>
													<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Monday">
														<?php foreach($MondayBdata as $MondayBdatas){ ?>
														<div class="hour-row text-nowrap" data-hourid="<?php echo base64_encode(convert_uuencode(@$MondayBdatas->id)); ?>" data-opentime24="<?php echo $MondayBdatas->opentime; ?>" data-closetime24="<?php echo $MondayBdatas->closetime; ?>">
															<span><?php echo date('h:i A', strtotime($MondayBdatas->opentime)); ?></span>&nbsp;to&nbsp;<span><?php echo date('h:i A', strtotime($MondayBdatas->closetime)); ?></span>
															<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>
															<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>
														</div>
														<?php } ?>
													</td>
													<?php }else{
														?>
														<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Monday"><span class="closed">Closed</span></td>
														<?php
													} ?>
												
												<td><a href="javascript:;" class="add-hours">Add Hours</a></td>
											</tr>
											<?php
										$query1 = \App\Hour::where('day', 'Tuesday')->where('hour_type', 'business')->where('user_id', $fetchedData->id);
										$TuesdayBcount = $query1->count();
										$TuesdayBdata = $query1->get();
										?>
											<tr>
												<td>Tuesday</td>
												<?php
													if($TuesdayBcount !== 0){
													?>
													<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Tuesday">
														<?php foreach($TuesdayBdata as $TuesdayBdatas){ ?>
														<div class="hour-row text-nowrap" data-hourid="<?php echo base64_encode(convert_uuencode(@$TuesdayBdatas->id)); ?>" data-opentime24="<?php echo $TuesdayBdatas->opentime; ?>" data-closetime24="<?php echo $TuesdayBdatas->closetime; ?>">
															<span><?php echo date('h:i A', strtotime($TuesdayBdatas->opentime)); ?></span>&nbsp;to&nbsp;<span><?php echo date('h:i A', strtotime($TuesdayBdatas->closetime)); ?></span>
															<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>
															<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>
														</div>
														<?php } ?>
													</td>
													<?php }else{
														?>
														<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Tuesday"><span class="closed">Closed</span></td>
														<?php
													} ?>
												
												<td><a href="javascript:;" class="add-hours">Add Hours</a></td>
											</tr>
											<?php
										$query1 = \App\Hour::where('day', 'Wednesday')->where('hour_type', 'business')->where('user_id', $fetchedData->id);
										$WednesdayBcount = $query1->count();
										$WednesdayBdata = $query1->get();
										?>
											<tr>
												<td>Wednesday</td>
												<?php
													if($WednesdayBcount !== 0){
													?>
													<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Wednesday">
														<?php foreach($WednesdayBdata as $WednesdayBdatas){ ?>
														<div class="hour-row text-nowrap" data-hourid="<?php echo base64_encode(convert_uuencode(@$WednesdayBdatas->id)); ?>" data-opentime24="<?php echo $WednesdayBdatas->opentime; ?>" data-closetime24="<?php echo $WednesdayBdatas->closetime; ?>">
															<span><?php echo date('h:i A', strtotime($WednesdayBdatas->opentime)); ?></span>&nbsp;to&nbsp;<span><?php echo date('h:i A', strtotime($WednesdayBdatas->closetime)); ?></span>
															<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>
															<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>
														</div>
														<?php } ?>
													</td>
													<?php }else{
														?>
														<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Wednesday"><span class="closed">Closed</span></td>
														<?php
													} ?>
												
												<td><a href="javascript:;" class="add-hours">Add Hours</a></td>
											</tr>
											<?php
										$query1 = \App\Hour::where('day', 'Thursday')->where('hour_type', 'business')->where('user_id', $fetchedData->id);
										$ThursdayBcount = $query1->count();
										$ThursdayBdata = $query1->get();
										?>
											<tr>
												<td>Thursday</td>
												<?php
													if($ThursdayBcount !== 0){
													?>
													<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Thursday">
														<?php foreach($ThursdayBdata as $ThursdayBdataBdatas){ ?>
														<div class="hour-row text-nowrap" data-hourid="<?php echo base64_encode(convert_uuencode(@$ThursdayBdataBdatas->id)); ?>" data-opentime24="<?php echo $ThursdayBdataBdatas->opentime; ?>" data-closetime24="<?php echo $ThursdayBdataBdatas->closetime; ?>">
															<span><?php echo date('h:i A', strtotime($ThursdayBdataBdatas->opentime)); ?></span>&nbsp;to&nbsp;<span><?php echo date('h:i A', strtotime($ThursdayBdataBdatas->closetime)); ?></span>
															<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>
															<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>
														</div>
														<?php } ?>
													</td>
													<?php }else{
														?>
														<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Thursday"><span class="closed">Closed</span></td>
														<?php
													} ?>
												
												<td><a href="javascript:;" class="add-hours">Add Hours</a></td>
											</tr>
											<?php
										$query1 = \App\Hour::where('day', 'Friday')->where('hour_type', 'business')->where('user_id', $fetchedData->id);
										$FridayBcount = $query1->count();
										$FridayBdata = $query1->get();
										?>
											<tr>
												<td>Friday</td>
												<?php
													if($FridayBcount !== 0){
													?>
													<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Friday">
														<?php foreach($FridayBdata as $FridayBdatas){ ?>
														<div class="hour-row text-nowrap" data-hourid="<?php echo base64_encode(convert_uuencode(@$FridayBdatas->id)); ?>" data-opentime24="<?php echo $FridayBdatas->opentime; ?>" data-closetime24="<?php echo $FridayBdatas->closetime; ?>">
															<span><?php echo date('h:i A', strtotime($FridayBdatas->opentime)); ?></span>&nbsp;to&nbsp;<span><?php echo date('h:i A', strtotime($FridayBdatas->closetime)); ?></span>
															<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>
															<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>
														</div>
														<?php } ?>
													</td>
													<?php }else{
														?>
														<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Friday"><span class="closed">Closed</span></td>
														<?php
													} ?>
												<td><a href="javascript:;" class="add-hours">Add Hours</a></td>
											</tr>
											<?php
										$query1 = \App\Hour::where('day', 'Saturday')->where('hour_type', 'business')->where('user_id', $fetchedData->id);
										$SaturdayBcount = $query1->count();
										$SaturdayBdata = $query1->get();
										?>
											<tr>
												<td>Saturday</td>
												<?php
													if($SaturdayBcount !== 0){
													?>
													<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Saturday">
														<?php foreach($SaturdayBdata as $SaturdayBdatas){ ?>
														<div class="hour-row text-nowrap" data-hourid="<?php echo base64_encode(convert_uuencode(@$SaturdayBdatas->id)); ?>" data-opentime24="<?php echo $SaturdayBdatas->opentime; ?>" data-closetime24="<?php echo $SaturdayBdatas->closetime; ?>">
															<span><?php echo date('h:i A', strtotime($SaturdayBdatas->opentime)); ?></span>&nbsp;to&nbsp;<span><?php echo date('h:i A', strtotime($SaturdayBdatas->closetime)); ?></span>
															<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>
															<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>
														</div>
														<?php } ?>
													</td>
													<?php }else{
														?>
														<td style="padding: .75rem;" class="day-hours" data-hourtype="business" data-day="Saturday"><span class="closed">Closed</span></td>
														<?php
													} ?>
												<td><a href="javascript:;" class="add-hours">Add Hours</a></td>
											</tr>
											
										</tbody>
									</table>
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
	var LoadingText = '<div class="modal-body"><div class="text-center w-100 m-3 align-middle"><i class="fas fa-sync fa-spin"></i> Loading... Please Wait...</div></div>';
	
	
	
	
	$(document).on('click', '.hour-row .hour-change', function () {
			var parent = $(this).closest('.hour-row');

			parent.data('current-html', parent.html());
			var opentime = parent.data('opentime24');
			var closetime = parent.data('closetime24');

			parent.empty().append(
				$('<input style="display: inline-block;width: auto;" class="form-control opentime" type="time">').prop('value', opentime),
				$('<label style="display: inline-block;margin-bottom: .5rem;" class="font-weight-normal">&nbsp;to&nbsp;</label>'),
				$('<input style="display: inline-block;width: auto;" class="form-control closetime" type="time">').prop('value', closetime),
				$('<button class="btn btn-primary btn-sm mb-1"><i class="fas fa-check"></i></button>'),
				$('<button class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>')
			);

			return false;
	
	});
 
	$(document).delegate('.hour-row .btn-primary', 'click', function () {
		
			var parent = $(this).closest('.hour-row');
			parent.find('.opentime, .closetime').removeClass('is-invalid');
			parent.find('.invalid-feedback').remove();

			var opentime = parent.find('.opentime').val();
			var closetime = parent.find('.closetime').val();

			if (!opentime || !closetime) {
				parent.find('.opentime, .closetime').addClass('is-invalid').css({ 'background-image': 'none', 'padding-right': '0.75em' });
				parent.append($("<div class='invalid-feedback'>Hours can&#39;t be empty</div>"));
				return false;
			}
			if (opentime >= closetime && opentime != '00:00' && closetime != '00:00') {
				parent.find('.opentime, .closetime').addClass('is-invalid').css({ 'background-image': 'none', 'padding-right': '0.75em' });
				parent.append($('<div class="invalid-feedback">Open time should be earlier than Close time</div>'));
				return false;
			}
			$.ajax({
			   type: "POST",
			   data: {"_token": $('meta[name="csrf-token"]').attr('content'),"openTime": opentime, "closeTime": closetime, "day": parent.closest('.day-hours').data('day'), "type": parent.closest('.day-hours').data('hourtype'), "hourId": parent.data('hourid'), "user_id": '{{$fetchedData->id}}'},
			   url: '{{URL::to('/restaurant/addHour')}}',
			   success: function(result){
				   var obj = JSON.parse(result);
				 if (obj.success) {
						parent.empty()
							.data('hourid', obj.hourId)
							.data('opentime24', opentime)
							.data('closetime24', closetime)
							.append(
								$('<span>').text(obj.openTimef), '&nbsp;to&nbsp;',
								$('<span>').text(obj.closeTimef),
								$('<a href="#" class="hour-change"><i class="fas fa-edit"></i></a>'),
								$('<a href="#" class="hour-remove"><i class="far fa-trash-alt"></i></a>')
							);
					} else {
						parent.find('.opentime, .closetime').addClass('is-invalid').css({ 'background-image': 'none', 'padding-right': '0.75em' });
						parent.append($('<div class="invalid-feedback">' + obj.msg + '</div>'));
					}
			   }
			});
			

			return false;
		});


	
	$(document).on('click', '.add-hours', function () {
			var parent = $(this).closest('tr').find('.day-hours');
			if (!parent.find('.hour-row').length)
				parent.empty();

			parent.append(
				$('<div class="hour-row text-nowrap">').append(
					$('<input class="form-control opentime" style="display: inline-block;width: auto;" type="time" value="11:00"><label class="font-weight-normal" style="display: inline-block;margin-bottom: .5rem;">&nbsp;to&nbsp;</label><input class="form-control closetime" style="display: inline-block;width: auto;" type="time" value="14:00">'),
					$('<button class="btn btn-primary btn-sm mb-1"><i class="fas fa-check"></i></button>'),
					$('<button class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>')
				)
			);

			//updateCategoryHourText();
			return false;
		});
		
		$(document).on('click', '.hour-row .btn-danger', function () {
			var parent = $(this).closest('.hour-row');
			var hourid = parent.data('hourid');
			if (hourid) {
				parent.html(parent.data('current-html'));
			} else {
				parent.remove();
				updateCategoryHourText();
			}
		});

		function updateCategoryHourText() {
			
				$('.day-hours:not(:has(.hour-row))').text('Closed');
		
		}

		$(document).on('click', '.hour-row .hour-remove', function () {
			var parent = $(this).closest('.hour-row');
			$.get('/restaurant/RemoveHour/' + parent.data('hourid')+'?user_id={{$fetchedData->id}}', null, function (result) {
				var obj = JSON.parse(result);
				if (obj.success) {
					parent.remove();
					updateCategoryHourText();
				}
			}); 
			return false;
		});
		
		
	$(document).on('click', '#carryout', function () {
            $.post('/CopyBusinessHours', { "_token": $('meta[name="csrf-token"]').attr('content'),id: 'carryout'}, function (data) {
					location.reload(true)
				})
		});

		$(document).on('click', '#deliveryout', function () {
            $.post('/CopyBusinessHours', { "_token": $('meta[name="csrf-token"]').attr('content'),id: 'delivery'}, function (data) {
					location.reload(true)
				})
		});	
});
</script>
@endsection