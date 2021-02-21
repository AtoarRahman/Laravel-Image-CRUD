<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        </style>
    </head>
<body>


<div class="container mt-3">
	<div class="row">
		<div class="col-md-12">
			<h5 class="float-left">Multi-Image List</h5>
			<a class="btn btn-info float-right" href="{{url('/')}}">Back</a>
			<a class="btn btn-success float-right mr-2" href="{{route('multiImages.create')}}">Add Image</a>
		</div>
		<div class="col-md-12">
			<table class="table mt-3">
			  <thead class="thead-dark">
				<tr>
				  <th width="5%">SL</th>
				  <th width="20%">Name</th>
				  <th width="20%">E-mail</th>
				  <th width="20%">Designation</th>
				  <th width="20%">Image</th>
				  <th width="15%">Action</th>
				</tr>
			  </thead>
			  <tbody id="table_data">
			  @foreach($multiImages as $data)
				<tr>
				    <td>{{ $loop->iteration }}</td>
					<td>{{ $data->name }}</td>
					<td>{{ $data->email }}</td>
					<td>{{ $data->designation }}</td>
					
					<td>
					@foreach($attachments as $file)
						<img src="{{ asset('uploads/'.$file->attachment) }}" alt="" width="25" />
					@endforeach		
					</td>
					<td><a href="{{ route('multiImages.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a> 
					<form action="{{ route('multiImages.destroy' , $data->id)}}" method="POST" class="d-inline-block">
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

</body>
</html>
