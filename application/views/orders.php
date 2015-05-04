<?php

// var_dump($orders_page);
// var_dump($pages);
// die();

// $this->session->sess_destroy();
// die();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sports | Admin</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- Custom CSS Style-->
<link href="/assets/stylesheets/orders.css" rel="stylesheet">
<!-- jquery always goes before the bootstrap java script -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse active background navbar-fixed-top">
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
        <form action="/admin/search_orders" class="navbar-form navbar-right" method="post">
           <div class="input-group">
               <input type="Search" name="search" placeholder="Search..." class="form-control" />
               <div class="input-group-btn">
                   <button class="btn btn-info" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                   </button>
               </div>
           </div>
        </form>

    </div>
    <div id='select_search' class="btn-group  pull-right">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Order Status <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="/admin/show_orders/in_process">In Process</a></li>
            <li><a href="/admin/show_orders/shipped">Shipped</a></li>
            <li><a href="/admin/show_orders/new">New</a></li>
            <li class="divider"></li>
            <li><a href="/admin/show_orders/show_all">Show All</a></li>
        </ul>
    </div>
    <div id='table' class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Billing Address</th>
                    <th>Total</th>
                    <th>Status</th>
            </thead>
            <tbody>
<?php

                foreach($orders as $order)
                { ?>
                    <tr>
                        <td><a href='/admin/order_details/<?=$order->id?>'><?=$order->id?></a></td>
                        <td><?=$order->first_name?></td>
                        <td><?=$order->created_at?></td>
                        <td><?=$order->address?> <?=$order->address2?> <?=$order->city?> <?=$order->state?> <?=$order->zip_code?></td>
                        <td><?=$order->order_total?></td>
                        <td id='select_status' class='btn-group'>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?=$order->order_status?> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/update_status/New/<?=$order->id?>">New</a></li>
                                <li><a href="/admin/update_status/In_process/<?=$order->id?>">In Process</a></li>
                                <li><a href="/admin/update_status/Shipped/<?=$order->id?>">Shipped</a></li>
                                <li><a href="/admin/update_status/Cancelled/<?=$order->id?>">Cancelled</a></li>
                            </ul>
                        </td>
                    </tr>
<?php           } ?>
            </tbody>
        </table>

        <div id='pagination'>
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
                $href_prev = '/admin/show_paginated_orders/' .$prev_page;
            }
            else
            {
                $class_prev = 'disabled';
                $href_prev = '#';
            }

            if (array_key_exists($next_page, $pages))
            {
                $class_next = 'enabled';
                $href_next = '/admin/show_paginated_orders/' .$next_page;
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
                <li class='<?=$class?>'><a href="/admin/show_paginated_orders/<?=$key?>"><?=$key?><span class="sr-only">(current)</span></a></li>
<?php
                }
            }
?>
            <li class='<?=$class_next?>'><a href='<?=$href_next?>'><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
            </ul>
        </nav>
        </div>
</body>
</html>























