@extends('Layout.app')
@section('title','Multi-Image Update')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron pt-3 mt-3">
				<h5>Multi-Image Update</h5>
				<hr/>
				<form method="POST" action="{{ route('multiImages.update', $editData->id) }}" enctype="multipart/form-data">
					@csrf
					@if (isset($editData))
						@method('PUT')
					@endif
				  <div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" value="{{$editData->name}}" class="form-control">
				  </div>
				  <div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" value="{{$editData->email}}" class="form-control">
				  </div>
				  <div class="form-group">
					<label for="designation">Designation</label>
					<input type="text" name="designation" value="{{$editData->designation}}" class="form-control">
				  </div>
				  <div class="form-group">
					<label for="image">Image</label>
					<div class="row">
						<div class="col-md-4">
							<input type="file"
							   class="form-control"
							   name="attachment[]" id="attachment" multiple
							   accept=".png, .jpg, .jpeg, .pdf">

						</div>
						<div class="col-md-8">
						@foreach($attachments as $file)
						<a href="{{ asset('uploads/'.$file->attachment) }}" target="_blank">
						   <img src="{{ asset('uploads/'.$file->attachment) }}" alt="" width="50" />
						 </a>
						@endforeach
							
						
						</div>
					</div>
				  </div>
				  <button type="submit" class="btn btn-success btn-sm">Update</button>
				  <a href="{{route('multiImages.index')}}" class="btn btn-info btn-sm">Back</a>
				</form>
			</div>		
		</div>
	</div>
</div>


@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection
