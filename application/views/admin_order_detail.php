<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sports | Admin</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- Custom CSS Style-->
<link href="/assets/stylesheets/order_detail.css" rel="stylesheet">
<!-- jquery always goes before the bootstrap java script -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div id="navbar">
            <ul class="nav navbar-nav navbar-left">
            <li><a href="/admin/show_orders">Dashboard</a></li>
            <li><a href="/admin/show_orders">Orders</a></li>
            <li><a href="/admin_prod/index">Products</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li id='logoff'><a href="/admin/logOff">Log Off</a></li>
            </ul>
        </div>
    </nav>

      <div id='customer_info'>
        <div id="shipping_info">
            <p>Order ID: <?= $customer_info['id'] ?></p>
            <p>Name: <?= $customer_info['first_name'].' '. $customer_info['last_name'] ?></p>
            <p>Address: <?= $customer_info['address'].' '. $customer_info['address2'] ?></p>
            <p>City: <?= $customer_info['city'] ?></p>
            <p>State: <?= $customer_info['state'] ?></p>
            <p>Zip: <?= $customer_info['zip_code'] ?></p>
        </div>

        <div id="billing_info">
            <p>Name: <?= $billing['first_name'].' '. $billing['last_name'] ?></p>
            <p>Address: <?= $billing['address'].' '. $billing['address2'] ?></p>
            <p>City: <?= $billing['city'] ?></p>
            <p>State: <?= $billing['state'] ?></p>
            <p>Zip: <?= $billing['zip_code'] ?></p>
        </div>
    </div>
    <div id='table' class="table-responsive">
        <table class="table table-striped">
            <thead>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
            </thead>
            <tbody>
<?php
        foreach ($products as $product)
        {   ?>
                    <tr>
                        <td><?= $product['product_id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['price'] * $product['quantity'] ?></td>
                    </tr>
<?php    } ?>

                    <tr class='table_totals'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class='order_totals'>Sub Total:</td>
                        <td><?= $products[0]['order_total'] ?></td>
                    </tr>

                    <tr class='table_totals'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class='order_totals'>Shipping:</td>
                        <td><?= $products[0]['shipping_price'] ?></td>
                    </tr>

                    <tr class='table_totals'>
                        <td class='order_status'>Status: <?= $products[0]['order_status'] ?></td>
                        <td></td>
                        <td></td>
                        <td class='order_totals'>Total Price:</td>
                        <td><?= $products[0]['order_total'] + $products[0]['shipping_price'] ?></td>
                    </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
