<!DOCTYPE html>
<html>
  <head>
  	<title>Sports | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  </head>

  <body>
    <div class="container">
      <div class='header'>
				<h1>Add Product</h1>
			</div>
      <form action='/admin_prod/add' method='post' role="form" class='form-horizontal'>
        <div class="form-group">
          <label for="name">Name:</label>
          <input name='name' type="text" class="form-control" placeholder="Enter name">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea name='description' class="form-control" placeholder="Enter password"></textarea>
        </div>
        <div class="form-group">
          <label for="category">Category:</label>
          <select name='category'>
						<option value='basketball'>Basketball</option>
						<option value='running'>Running</option>
						<option value='golf'>Golf</option>
						<option value='tennis'>Tennis</option>
					</select>
					<p>or add new category: <input name='category' type="text" class="form-control" placeholder="Enter category"></p>
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input name='price' type="text" class="form-control" placeholder="Enter price">
        </div>
        <div class="form-group">
          <label for="gender">Gender:</label>
          <select name='gender'>
						<option value='male'>Male</option>
						<option value='female'>Female</option>
					</select>
        </div>
        <div class="form-group">
          <label for="color">Color:</label>
          <input name='color' type="text" class="form-control" placeholder="Enter color">
        </div>
        <div class="form-group">
          <label for="brand">Brand:</label>
          <input name='brand' type="text" class="form-control" placeholder="Enter brand">
        </div>
        <div class="form-group">
          <label for="model">Model #:</label>
          <input name='model' type="text" class="form-control" placeholder="Enter model">
        </div>
        <div class="form-group">
          <label for="inventory">Inventory Count:</label>
          <input name='inventory_count' type="text" class="form-control" placeholder="Enter inventory count">
        </div>
        <div class="form-group">
          <label for="photo">Photo Link:</label>
          <input name='photo' type="text" class="form-control" placeholder="Enter photo link">
        </div>

       <input type='submit' name='submit' value='Add' class='btn btn-default'>
      </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>


<!-- <html>
<head>
	<title>Add Product</title>
</head>
<body>
		
		<form action='/admin_prod/add' method='post'>
			<div class='product_info'>
				<p>Name: <input type='text' name='name'></p>
				<p>Description: <textarea name='description'></textarea></p>
				<p>Categories:	<select name='category'>
													<option value='basketball'>Basketball</option>
													<option value='running'>Running</option>
													<option value='golf'>Golf</option>
													<option value='tennis'>Tennis</option>
												</select>
				<p>or add new category: <input type='text' name='category'></p>
				<p>Type:	<select name='type'>
										<option value='shirts'>Shirt</option>
										<option value='shoes'>Shoes</option>
										<option value='shorts'>Shorts</option>
									</select>
				<p>or add new type: <input type='text' name='type'></p>
				<p>Price: <input type='text' name='price'></p>
				<p>Gender: 	<select name='gender'>
										<option value='male'>Male</option>
										<option value='female'>Female</option>
									</select>
				<p>Color: <input type='text' name='color'></p>
				<p>Brand: <input type='text' name='brand'></p>
				<p>Model #: <input type='text' name='model'></p>
				<p>Inventory Count: <input type='text' name='inventory_count'></p>
				<p>Photo link: <input type='text' name='photo'></p>
				<!- <input type='submit' value='Cancel'>
				<input type='submit' value='Preview'> -->
				<!-- <input type='submit' name='submit' value='Add'> -->

			<!-- </form>
			</div>
		</div>

</body>
</html> -->


