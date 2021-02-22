@extends('Layout.app')
@section('title','Multi-Image Create')
@section('content')

<div class="container">
<div class="row">
		<div class="col-md-12">
			<div class="jumbotron pt-3 mt-3">
				<h5>Multi-Image Create</h5>
				<hr/>
				<form method="POST" action="{{route('multiImages.store')}}" enctype="multipart/form-data">
					@csrf
				  <div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" placeholder="Enter name" class="form-control">
				  </div>
				  <div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" placeholder="Enter email" class="form-control">
				  </div>
				  <div class="form-group">
					<label for="designation">Designation</label>
					<input type="text" name="designation" placeholder="Enter designation" class="form-control">
				  </div>
				  <div class="form-group">
					<label for="attachment">Attachment</label>
					<input type="file"
					   class="form-control"
					   name="attachment[]" id="attachment" multiple
					   accept=".png, .jpg, .jpeg, .pdf">
				  </div>
				  <button type="submit" class="btn btn-success btn-sm">Submit</button>
				  <a href="{{url('/')}}" class="btn btn-info btn-sm">Back</a>
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
