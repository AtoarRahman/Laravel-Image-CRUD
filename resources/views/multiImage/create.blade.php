<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Laravel Image CURD</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
</head>
<body>
<div class="container mt-3">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
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

</body>
</html>