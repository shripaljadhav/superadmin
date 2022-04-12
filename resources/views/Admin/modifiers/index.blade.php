@extends('layouts.admin')
@section('title', 'Modifier Groups')

@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
            <div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="server-error"> 
						@include('../Elements/flash-message')
						<span class="custom-error-msg"></span> 
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header"> 
							<h4>Modifier Groups</h4>
							<div class="mr_left_auto">
								<a class="btn btn-primary" href="{{route('admin.modifiers.create')}}">Add New</a>
							</div>
						</div> 
						<div class="card-body p-0">
							<div class="table-responsive">
								<table class="table table-striped table-md">
									<thead>
										<tr>
										 
										  <th>Name</th>
										  <th>Contains</th>
										  <th>Items Using</th>
										
										</tr>
									</thead>
									@if(@$totalData !== 0)
									<tbody class="tdata">
										@foreach (@$lists as $list)
											<?php
											$ee = unserialize($list->items);
											$itemcontain = array();
											 foreach($ee as $e){
												$iteminfo = \App\Item::where('id', $e['item'])->first();
												
												$itemcontain[] = $iteminfo->name;
											} 
											$itemtooltipdata = '';
											
											if(count($itemcontain) > 2){
												$itemtooltipdata = implode(', ',$itemcontain);
												$itemdata = $itemcontain[0].', '.$itemcontain[1].', +'. (count($itemcontain) - 2);
											}else{
												$itemdata = implode(', ',$itemcontain);
											}
											?>
											<tr>
												<td><a href="{{URL::to('/modifiers/edit/'.base64_encode(convert_uuencode(@$list->id)))}}">{{$list->name}}</a></td>
												<td><span data-toggle="tooltip" data-placement="top"
                      title="{{$itemtooltipdata}}">{{@$itemdata}}</span></td>
												<td></td>
											</tr>
										@endforeach  
									</tbody>
									@else
									<tbody>
										<tr>
											<td colspan="6">
												{{config('constants.no_data')}}
											</td>
										</tr>
									</tbody>
									@endif
								</table>
							</div>
						</div>
						{{ $lists->links() }}
					</div>
				</div>              
            </div>
		</div>
	</section> 
</div>

@endsection