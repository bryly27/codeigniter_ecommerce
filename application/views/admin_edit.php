<html>
<head>
	<title>Sports | Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
		<div class='container'>
			<div class='header'>
				<h1>Edit Product</h1>
			</div>
			<form action='/admin_prod/update' method='post' role="form" class='form-horizontal'>
				<div class='product_info'>
					<div class="form-group">
	          <label for="name">Name:</label>
	          <input name='name' type="text" class="form-control" value="<?= $products['name'] ?>">
        	</div>
        	<div class="form-group">
	          <label for="description">Description:</label>
	          <textarea name='description' class="form-control"><?= $products['description'] ?></textarea>
	        </div>
	        <div class="form-group">
	          <label for="category">Category:</label>
	          <input name='category' type="text" class="form-control" value="<?= $products['category'] ?>">
	        </div>
	        <div class="form-group">
	          <label for="type">Type:</label>
	          <input name='type' type="text" class="form-control" value="<?= $products['type'] ?>">
	        </div>
	        <div class="form-group">
	          <label for="price">Price:</label>
	          <input name='price' type="text" class="form-control" value='<?= $products['price'] ?>'>
	        </div>
	        <div class="form-group">
	          <label for="gender">Gender:</label>
	          <input name='gender' type="text" class="form-control" value='<?= $products['gender'] ?>'>
	        </div>
	        <div class="form-group">
	          <label for="color">Color:</label>
	          <input name='color' type="text" class="form-control" value='<?= $products['color'] ?>'>
	        </div>
	        <div class="form-group">
	          <label for="brand">Brand:</label>
	          <input name='brand' type="text" class="form-control" value='<?= $products['brand'] ?>'>
	        </div>
	        <div class="form-group">
	          <label for="model">Model:</label>
	          <input name='model' type="text" class="form-control" value='<?= $products['model'] ?>'>
	        </div>
	        <div class="form-group">
	          <label for="inventory">Inventory Count:</label>
	          <input name='inventory_count' type="text" class="form-control" value='<?= $products['inventory_count'] ?>'>
	        </div>
	        <div class="form-group">
	          <label for="photo">Photo Link:</label>
	          <input name='photo' type="text" class="form-control" value='<?= $products['photo'] ?>'>
	        </div>
	        <input type='submit' name='submit' value='update' class='btn btn-default'>
					<input type='hidden' name='submit' value='<?= $products['id'] ?>'>

				</form>
			</div>
		</div>

</body>
</html>
