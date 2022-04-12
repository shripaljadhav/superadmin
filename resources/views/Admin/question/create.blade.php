@extends('layouts.admin')
@section('title', 'Create Question')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			{{ Form::open(array('url' => 'admin/question/store', 'name'=>"add-question", 'autocomplete'=>'off', "enctype"=>"multipart/form-data")) }}
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
					</div>
				</div>
				<div class="col-9 col-md-9 col-lg-9">
					<div class="card">
						<div class="card-header"> 
							<h4>Question Info</h4>
						</div> 
						<div class="card-body">  
							<div class="form-group">
								<label>Question Name</label>
								<input type="text" name="title" data-valid="required" class="form-control"/>
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('title') }}</strong>
									</span> 
								@endif
							</div> 
							<div class="form-group">
								<label>Question Type</label>
								<select name="question_type" class="form-control" data-valid="required">
									<option value="">Choose One...</option>
									<option value="Behavior">Behavior</option>
									<option value="Attitude">Attitude</option>
									<option value="Skills">Skills</option>
									<option value="knowledge">knowledge</option>
									<option value="Psychometry">Psychometry</option>
								</select>
							</div>	
							<div class="form-group">
								<label>Description</label>
								<textarea id="editor1" name="descriptions" placeholder="Description" class="summernote-simple"></textarea>
							</div>
							<div class="alloptions">
								<div class="form-group myoption">	
									<div class="row">
										<div class="col-md-6">
											<label>Options</label>
											<input type="text" name="option_1" placeholder="Option 1" class="form-control mysort"/>
										</div>
										<div class="col-md-6">
											<label>Answer</label>
											<div class="form-check form-check-block">
												<input class="form-check-input mysortanswer" name="answer" type="radio" id="option1" value="1">
												<label class="form-check-label mysortlabel" for="option1">Is Answer</label>
											</div>
										</div>	
									</div>	
								</div>	
								<div class="form-group myoption">
									<div class="row">
										<div class="col-md-6">
											<input type="text" name="option_2" placeholder="Option 2" class="form-control mysort"/>
										</div>
										<div class="col-md-6">
											<div class="form-check form-check-block">
												<input class="form-check-input mysortanswer" name="answer" type="radio" id="option2" value="2">
												<label class="form-check-label mysortlabel" for="option2">Is Answer</label>
											</div>
										</div>
									</div>
								</div>													
							</div>
							<div class="form-group addmoreoption">
								<a href="javascript:;" class="add_more"><i class="fa fa-plus"></i> Click to add more options</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3 col-md-3 col-lg-3">
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
							<a style="margin-right:5px;" href="{{route('admin.question.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>  
							<button type="button" onClick="customValidate('add-question')" class="btn btn-success pull-right">Submit</button>  
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
		$(document).delegate('.remove_option', 'click', function(){
			$(this).parent().parent().parent().remove();
			numbersort();
		});
		function numbersort(){
			var i = 1;
			var s = 1;
			var l = 1;
			$('.mysort').each(function(){
				$(this).attr('name', 'option_'+i);
				$(this).attr('placeholder', 'Option '+i);
				i++;
			});
			$('.mysortanswer').each(function(){
				$(this).attr('value', s);
				$(this).attr('id', 'option'+s);
				s++;
			});
			$('.mysortanswer').each(function(){
				$(this).attr('for', 'option'+l);

				l++;
			});
			
		}
		$(document).delegate('.add_more', 'click', function(){
			var v = $('.myoption').length;
			
			var t = parseInt(v+1);
			if(t <= 5){
			$('.alloptions').append(' <div class="form-group myoption my_new_option"><div class="row"><div class="col-md-6"><input type="text" name="option_'+t+'" class="form-control mysort" id="" placeholder="Option '+t+'"/></div><div class="col-md-4"><div class="form-check form-check-block"><input class="form-check-input mysortanswer" name="answer" type="radio" id="option'+t+'" value="'+t+'"><label class="form-check-label mysortlabel" for="option'+t+'">Is Answer</label></div></div><div class="col-md-2"><a href="javascript:;" class="remove_option"><i class="fa fa-minus"></i></a></div></div></div>');
			
			}else{
				
			}
			numbersort();
		});
	});
</script>
@endsection