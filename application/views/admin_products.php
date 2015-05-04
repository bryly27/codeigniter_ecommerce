<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sports | Admin</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- Custom CSS Style-->

<!-- jquery always goes before the bootstrap java script -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link href="/assets/stylesheets/products.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div id="navbar">
      <ul class="nav navbar-nav navbar-left">
      <li><a href="/admin/show_orders">Dashboard</a></li>
      <li><a href="/admin/show_orders">Orders</a></li>
      <li><a href="/admin/show_products">Products</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li id='logoff'><a href="/admin/logOff">Log Off</a></li>
      </ul>
    </div>
  </nav>

  <div id='search'>
    <form action="/admin_prod/search" method='post' class="navbar-form navbar-right">
     <div class="input-group">
       <input type="Search" name='search' placeholder="Search..." class="form-control" />
       <div class="input-group-btn">
         <button class="btn btn-info">
            <span class="glyphicon glyphicon-search"></span>
         </button>
       </div>
     </div>
    </form>
  </div>
  <div id='table' class="table-responsive">
    <table class="table table-striped table-hover">
    <div id='add_product'>
      <form action='/admin_prod/add' method='post'>
        <button class="btn btn-sm btn-primary active" type='submit'> Add New Product</button>
        <input type='hidden' name='edit' value='add'>
      </form>
    </div>
    <thead>
      <th>Picture</th>
      <th>ID</th>
      <th>Name</th>
      <th>Inventory Count</th>
      <th>Quantity Sold</th>
      <th>Action</th>
    </thead>
    <tbody>
<?php
      foreach ($products as $product)
      { ?>
        <tr>
          <td><img class='img' src='<?= $product['photo'] ?>'></td>
          <td><?= $product['id'] ?></td>
          <td><?= $product['name'] ?></td>
          <td><?= $product['inventory_count'] ?></td>
          <td><?= $product['quantity_sold'] ?></td>
          <td id='action'>
          <a href='/admin_prod/edit/<?= $product['id'] ?>'>edit</a>
          <a href='/admin_prod/delete/<?= $product['id'] ?>'>delete</a>
          </td>
      </tr>
<?php   } ?>

    </tbody>
        </table>

        <div class='pagination'>
        <nav class="text-center">
            <ul class="pagination">

<?php
            $pages = $this->session->userdata('pages');
            $current_page = $pages['current_page'];
            $prev_page = $current_page - 1;
            $next_page = $current_page + 1;
            if (array_key_exists($prev_page, $pages))
            {
                $class_prev = 'enabled';
                $href_prev = '/admin_prod/show_paginated_products/' .$prev_page;
            }
            else
            {
                $class_prev = 'disabled';
                $href_prev = '#';
            }

            if (array_key_exists($next_page, $pages))
            {
                $class_next = 'enabled';
                $href_next = '/admin_prod/show_paginated_products/' .$next_page;
            }
            else
            {
                $class_next = 'disabled';
                $href_next = '#';
            }
?>
            <li class='<?=$class_prev?>'><a href='<?=$href_prev?>'><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
<?php

            foreach($pages as $key => $val)
            {
                if($key == $current_page)
                    $class = 'active';
                else
                    $class = 'inactive';

                if($key !== 'current_page')
                {
?>
                <li class='<?=$class?>'><a href="/admin_prod/show_paginated_products/<?=$key?>"><?=$key?><span class="sr-only">(current)</span></a></li>
<?php
                }
            }
?>
            <li class='<?=$class_next?>'><a href='<?=$href_next?>'><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
            </ul>
        </nav>
        </div>

<!--

            <li class="disabled"><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
            <li class="inactive"><a href="#">2 </a></li>
            <li class="inactive"><a href="#">3 </a></li>
            <li class="inactive"><a href="#">4 </a></li>
            <li class="enabled"><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
            </ul>
        </nav>
        </div> -->


</body>
</html>
