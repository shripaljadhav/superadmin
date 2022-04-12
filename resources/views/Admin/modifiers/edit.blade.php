@extends('layouts.admin')
@section('title', 'Edit Modifiers')

@section('content')
<style>
.menuerror .invalid-feedback{display:block;}
.selecteditems ul{list-style-type: none;}
.selecteditems ul li{border: 1px solid #E0E0E0;padding: 10px;height: 66px;}

</style>
<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'modifiers/edit', 'name'=>"add-learning", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
			{{ Form::hidden('id', @$fetchedData->id) }}  
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Edit Modifiers</h4>
						</div>
						<div class="card-body">
							
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" value="<?php echo @$fetchedData->name; ?>" name="name" data-valid="required" class="form-control"/>
								@if ($errors->has('name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('name') }}</strong>
									</span> 
								@endif
							</div>
							<?php
								$ee = unserialize($fetchedData->items);
								$rit = '';
								 foreach($ee as $e){
									$rit .= $e['item'].', ';
								 }
								?>
							<div class="form-group">
								<label for="items">Add Item</label>
								<div class="row">
									<div class="col-md-6">
										<select class="form-control mutiitems select2" placeholder="Add a Item"  multiple="" name="items">
											<?php $itemlist = array(); ?>
											@foreach(\App\Item::where('restaurant_id', Auth::user()->id)->orderby('name','ASC')->get() as $list)
												<?php
												$itemlist[$list->id] = array('name'=> $list->name, 'price'=> $list->price);
												?>
												<option value="{{$list->id}}">{{$list->name}}</option>
											@endforeach
										</select>
										<input type="hidden" value="{{rtrim($rit, ',')}}" id="itemseleted" data-valid="required">
									</div>
									<div class="col-md-6">
										<a href="javascript:;" class="btn btn-light add_item">Add</a>
									</div>								
								</div>								
							</div>	
							<div class="selecteditems">
								<ul>
								<?php
								$ee = unserialize($fetchedData->items);
								 foreach($ee as $e){
									 $iteminfo = \App\Item::where('id', $e['item'])->first();
								?>
									<li>
										<input type="hidden" value="{{$e['item']}}" name="itemid[]">
										<div class="sortitem">
											<div class="liitem">
												<div class="row">
													<div class="col-md-6">
														<div style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><?php echo $iteminfo->name; ?></div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">$</div>
																</div>
																<input data-valid="" value="<?php echo $e['price']; ?>" type="number" name="price[]" class="form-control currency">
															</div>
														</div>
													</div>
													<div class="col-md-2">
														<a href="javascript:;" rid="{{$e['item']}}" class="rem_item"><i class="fa fa-times"></i></a>
													</div>
												</div>
											</div>
										</div>
									</li>
								 <?php } ?>
								</ul>
							</div>	
							<hr>
							<h6>Rules</h6>
							<p>Set rules to control how customers select items in this modifier group</p>
							<div class="form-group">
								<div class="row">
									<label class="col-md-9">What’s the minimum number of options a customer must select?</label>
									<div class="col-md-3">
										<input type="number" name="minPermittedTotal" data-valid="" class="form-control" value="<?php echo @$fetchedData->minPermittedTotal; ?>" placeholder="-" />
									</div>
									
								</div>
							</div>
							<div class="form-group">
								<div class="row">
								
									<label class="col-md-9">What’s the maximum number of options a customer can select?</label>
									<div class="col-md-3">
										<input type="number" name="maxPermittedTotal" data-valid="" class="form-control" value="<?php echo @$fetchedData->maxPermittedTotal; ?>" placeholder="-" />
									</div>
									
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									
									<label class="col-md-9">How many times can customers select any single option?</label>
									<div class="col-md-3">
										<input type="number" name="maxPermittedPerOption" data-valid="" class="form-control" value="<?php echo @$fetchedData->maxPermittedPerOption; ?>" placeholder="-" />
									</div>
								</div>
							</div>
						</div> 
					</div>
				</div>
				<div class="col-3 col-md-3 col-lg-3">
					<div class="card">
						<div class="card-header"> 
							<h4>Publish</h4>
						</div>
						
						<div class="card-footer"> 
							<a style="margin-right:5px;" href="{{route('admin.modifiers.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
							<button type="button" onClick="customValidate('add-learning')" class="btn btn-success pull-right">Save</button>
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
$(function() {
	var v = '<?php echo json_encode($itemlist); ?>';
    $("#ser_res").autocomplete({
        source: "{{URL::to('/search')}}",
        select: function( event, ui ) {
            event.preventDefault();
            $("#ser_res").val(ui.item.value);
            $("#reid").val(ui.item.id);
        }
    });
	
	$('.add_item').on('click', function(){
		var array = [];
		$('.mutiitems option:selected').each(function(){
			
			var c = $(this).val();
			var data = JSON.parse(v);
			console.log(data[c].name);
			
			$('.selecteditems ul').append('<li><input type="hidden" value="'+c+'" name="itemid[]"><div class="sortitem"><div class="liitem"><div class="row"><div class="col-md-6"><div style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">'+data[c].name+'</div></div><div class="col-md-4"><div class="form-group"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text">$</div></div><input data-valid="" value="'+data[c].price+'" type="number" name="price[]" class="form-control currency"></div></div></div><div class="col-md-2"><a href="javascript:;" rid="'+c+'" class="rem_item"><i class="fa fa-times"></i></a></div></div></div></div></li>');
		 $('.select2').find("[value='" + c + "']").prop("disabled", true);
		 array.push(c);
		});
		$('#itemseleted').val(array);
		$(".select2").val('').trigger('change');
	});
	
	$(document).delegate('.rem_item', 'click', function(){
		$(this).parent().parent().parent().parent().parent().remove();
		var array = '';
		var v = $(this).attr('rid');
		var c = $('#itemseleted').val();
		var cs = c.split(',');
		for(var i = 0 ; i < cs.length ; i++) {
			if(cs[i] == v) {
			  cs.splice(i, 1);
			  array =  cs.join(',');
			}
		  }
		  $('#itemseleted').val(array); 
	});
});
</script>
@endsection