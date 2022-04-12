<table class="table table-striped table-md">
	<thead>
		<tr>
			<th>Question Name</th>
			<th>Question Type</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	@foreach($questions as $qlist) 
		<tr id="sh_{{$qlist->id}}" mid="{{$qlist->id}}">
			<td class="question_title">{{$qlist->title}}</td>
			<td class="question_type">{{$qlist->question_type}}</td>
			<td><a href="javascript:;" class="btn btn-primary selectque">Select</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
{{ $questions->links() }}