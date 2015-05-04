<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sports | Admin</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- Custom CSS Style-->
<link href="assets/stylesheets/order_detail.css" rel="stylesheet">
<!-- jquery always goes before the bootstrap java script -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div id="navbar">
            <ul class="nav navbar-nav navbar-left">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="#">Products</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li id='logoff'><a href="/admin/logOff">Log Off</a></li>
            </ul>
        </div>
    </nav>
    <div id='customer_info'>
        <div id="shipping_info">
            <p>Name:</p>
            <p>Address:</p>
            <p>City:</p>
            <p>State:</p>
            <p>Zip:</p>
        </div>

        <div id="billing_info">
            <p>Name:</p>
            <p>Address:</p>
            <p>City:</p>
            <p>State:</p>
            <p>Zip:</p>
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
                    <tr>
                        <td>115</td>
                        <td>Shoe</td>
                        <td>99.99</td>
                        <td>1</td>
                        <td>99.99</td>
                    </tr>

                    <tr>
                        <td>115</td>
                        <td>Shoe</td>
                        <td>99.99</td>
                        <td>1</td>
                        <td>99.99</td>
                    </tr>

                    <tr>
                        <td>115</td>
                        <td>Shoe</td>
                        <td>99.99</td>
                        <td>1</td>
                        <td>99.99</td>
                    </tr>

                    <tr>
                        <td>115</td>
                        <td>Shoe</td>
                        <td>99.99</td>
                        <td>1</td>
                        <td>99.99</td>
                    </tr>

                    <tr>
                        <td>115</td>
                        <td>Shoe</td>
                        <td>99.99</td>
                        <td>1</td>
                        <td>99.99</td>
                    </tr>

                    <tr class='table_totals'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Sub Total</td>
                        <td>299.99</td>
                    </tr>

                    <tr class='table_totals'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Shipping</td>
                        <td>9.99</td>
                    </tr>

                    <tr class='table_totals'>
                        <td>Status: Shipped</td>
                        <td></td>
                        <td></td>
                        <td>Total Price</td>
                        <td>399.99</td>
                    </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
