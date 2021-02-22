@extends('Layout.app')
@section('title','Multi-Image List')
@section('content')

<div class="container mt-3">
	<div class="row">
		<div class="col-md-12">
			<h5 class="float-left">Multi-Image List</h5>
			<a class="btn btn-success float-right mr-2" href="{{route('multiImages.create')}}">Add Image</a>
		</div>
		<div class="col-md-12">
			<table class="table table-striped table-bordered mt-3">
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
						@if($data->id == $file->multiImage_id)
							<img src="{{ asset('uploads/'.$file->attachment) }}" alt="" width="25" />
						@endif	
					@endforeach		
					</td>
					<td><a href="{{ route('multiImages.edit', $data->id) }}" class="btn btn-primary p-1"><i class="fas fa-edit"></i></a> 
					<form action="{{ route('multiImages.destroy' , $data->id)}}" method="POST" class="d-inline-block">
						<input name="_method" type="hidden" value="DELETE">
						@csrf
						<button onclick="return confirm('Are you sure you want to delete?');" type="submit" class="btn btn-danger p-1"><i class="fas fa-trash"></i></button>
					</form>
					</td>
				</tr>
				@endforeach		
			  </tbody>
			</table>
		</div>
	</div>
</div>


@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection

