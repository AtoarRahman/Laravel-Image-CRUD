@extends('Layout.app')
@section('title','Single-Image List')
@section('content')

<div class="container mt-3">
	<div class="row">
		<div class="col-md-12">
			<h5 class="float-left">Single-Image List</h5>
			<a class="btn btn-info float-right" href="{{url('/')}}">Back</a>
			<a class="btn btn-success float-right mr-2" href="{{route('images.create')}}">Add Image</a>
		</div>
		<div class="col-md-12">
			<table class="table mt-3">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">SL</th>
				  <th scope="col">Name</th>
				  <th scope="col">E-mail</th>
				  <th scope="col">Designation</th>
				  <th scope="col">Image</th>
				  <th scope="col">Action</th>
				</tr>
			  </thead>
			  <tbody id="table_data">
			  @foreach($employees as $data)
				<tr>
				    <td>{{ $loop->iteration }}</td>
					<td>{{ $data->name }}</td>
					<td>{{ $data->email }}</td>
					<td>{{ $data->designation }}</td>
					
					<td><img src="{{ asset('uploads/'.$data->image) }}" alt="" width="25" /></td>
					<td><a href="{{ route('images.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a> 
					<form action="{{ route('images.destroy' , $data->id)}}" method="POST" class="d-inline-block">
						<input name="_method" type="hidden" value="DELETE">
						@csrf
						<button onclick="return confirm('Are you sure you want to delete?');" type="submit" class="btn btn-sm btn-danger">Delete</button>
					</form>

					
					</td>
				</tr>
				@endforeach		
			  </tbody>
			</table>
		</div>
	</div>
</div>
</div>


@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection

