@include('includes.header')

<div class="row">
<div class="col-md-6">
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-bank"></i> Company Details
	</div>
	<div class="card-body">
		<div class="card mb-3">
			<img class="card-img-top" src='{{ url("storage/logos/$companies->logo") }}' alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title"><?php echo $companies->name; ?></h5>
				<p class="card-text"><?php echo $companies->email; ?> <br/> <?php echo $companies->website; ?></p>
				<p class="card-text"><small class="text-muted">Assets</small></p>
			</div>
		</div>
	</div>
</div>
</div>

<div class="col-md-6">
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-bank"></i> Update Details
	</div>
	<div class="card-body">
		<div class="card-body">
			@if(count($errors) > 0)
				@foreach($errors->all() as $error)
					<div class="alert alert-danger">
						{{$error}}
					</div>
				@endforeach
			@endif
			<form id="add_assets" method="post" action="{{ url('/update', array($companies->id)) }}">
				{{csrf_field()}}
				<div class="form-group">
					<label for="exampleInputEmail1">Name</label>
					<input type="text" name="name" value="<?php echo $companies->name; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email</label>
					<input type="text" name="email" value="<?php echo $companies->email; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Website</label>
					<input type="text" name="website" value="<?php echo $companies->website; ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter website">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Logo</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="inputGroupFile02">
						<label class="custom-file-label" for="inputGroupFile02">Choose file</label>
					</div>
				</div>
				<div class="form-group" id="dynamic_field">
					<label for="exampleInputEmail1">Assets</label>
					<div class="input-group mb-3">
						<div class="col-md-2">
							<input type="text" id="asset" name="asset[]" class="form-control" placeholder="Asset" aria-label="Asset" aria-describedby="basic-addon2">
						</div>
						<div class="col-md-3">
							<input type="text" id="description" name="description[]" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="basic-addon2">
						</div>
						<div class="col-md-2">
							<input type="text" id="model" name="model[]" class="form-control" placeholder="Model" aria-label="Model" aria-describedby="basic-addon2">
						</div>
						<div class="col-md-2">
							<input type="decimal" id="value" name="value[]" class="form-control" placeholder="Value" aria-label="Value" aria-describedby="basic-addon2">
						</div>
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button" name="add" id="add">Add</button>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
</div>
</div>
</div>

@include('includes.footer')
<script>  
	$(document).ready(function(){  
		var i=1;  
		$('#add').click(function(){  
			i++;  
			$('#dynamic_field').append('<tr id="row'+i+'"><td style="width: 20%"><div ><input type="text" id="asset" name="asset[]" class="form-control" placeholder="Asset" aria-label="Asset" aria-describedby="basic-addon2"></div></td><td style="width: 20%"><div><input type="text" id="description" name="description[]" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="basic-addon2"></div></td><td style="width: 20%"><div><input type="text" id="model" name="model[]" class="form-control" placeholder="Model" aria-label="Model" aria-describedby="basic-addon2"></div></td><td style="width: 20%"><div><input type="decimal" id="value" name="value[]" class="form-control" placeholder="Value" aria-label="Value" aria-describedby="basic-addon2"></div></td><td style="width: 20%"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
		});  
		$(document).on('click', '.btn_remove', function(){  
			var button_id = $(this).attr("id");   
			$('#row'+button_id+'').remove();  
		});  
		$('#submit').click(function(){            
			$.ajax({  
				url:"name.php",  
				method:"POST",  
				data:$('#add_assets').serialize(),  
				success:function(data)  
				{  
					alert(data);  
					$('#add_assets')[0].reset();  
				}  
			});  
		});  
	});  
</script>