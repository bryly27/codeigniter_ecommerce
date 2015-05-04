<?php
            $pages = $this->session->userdata('pages');
            $current_page = $pages['current_page'];
            $prev_page = $current_page - 1;
            $next_page = $current_page + 1;
            if (array_key_exists($prev_page, $pages))
            {
                $class_prev = 'enabled';
                $href_prev = '/home/show_pagination/' .$prev_page;
            }
            else
            {
                $class_prev = 'disabled';
                $href_prev = '#';
            }
            if (array_key_exists($next_page, $pages))
            {
                $class_next = 'enabled';
                $href_next = '/home/show_pagination/' .$next_page;
            }
            else
            {
                $class_next = 'disabled';
                $href_next = '#';
            }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sports Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
      }
      .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      .product img {
        height: 150px;
      }
      .banner img{
        width: 100%;
      }
      .leftbar {
        margin-top: 200px;
      }
      .sort_button {
        margin-left: -100px;
      }
    </style>

    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script type="text/javascript">
      $(document).ready(function(){ 

        $.post(
          "/home/show_products", function(output){
            $('#display').html(output);
          });

//============= search bar ==================
        $("#search").on('keyup', function(){
          $.post(
            $("#submit").attr('action'),
            $("#submit").serialize(),
            function(output){
              $('#display').html(output);
            }
          );
          return false;
        });

//============== a tags ====================
        $(document).on('click', '#search_category', function(){
          event.preventDefault();
            var form = $(this);
          $.post(
              form.attr('href'),
              form.serialize(),
            function(output){
              $('#display').html(output);
            }
          );
          return false;
        });


      });
    </script>
  </head>

  <body>


    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/home">Shoe Store</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/cart">Shopping Cart(<?= $this->session->userdata('cart')['total_items'] ?>)</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>
    <!-- SECTION FOR FLASH MESSAGES==================================================== -->
    <?php
     if($this->session->flashdata("success"))
     {
      echo $this->session->flashdata("success");
     }
    ?>
    <!-- END SECTION FOR FLASH MESSAGES==================================================== -->
    <div class="container-fluid">
      <div id='image_banner' class='banner'>
        <img src="https://s3-us-west-1.amazonaws.com/codingdojoecommerce/background_images/sports-category-banner.jpg">
      </div>
      <div class="row-fluid">
        <div class="span3 leftbar">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <!-- <li class="nav-header"><a class="btn" data-toggle="collapse" data-target="#viewdetails">Sort by: &raquo;</a></li> -->
              <!-- <div class="collapse" id="viewdetails"> -->
                <li><a id='search_category' href="/home/show_products">Show All</a></li>
                <li class="divider"></li>
                <li><a id='search_category' href="/home/product/shirts">Shirts</a></li>
                <li><a id='search_category' href="/home/product/shoes">Shoes</a></li>
                <li><a id='search_category' href="/home/product/shorts">Shorts</a></li>
                <li><a id='search_category' href="/home/product/equipment">Equipment</a></li>

              <!-- </div>               -->
              <!-- </li> -->
                <form id="submit" action='/home/search' method='post' class="navbar-form navbar-left" role="search">
                  <div class="form-group">
                    <input id="search" type="text" class="form-control" name="search" placeholder="Find a product">
                  </div>
                  <!-- <button type="submit" class="glyphicon glyphicon-search"></button> -->
                </form>
              </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
        <nav class="text-center">
          <ul class="pager">
            <li class='<?=$class_prev?>'><a href='<?=$href_prev?>'>Previous</a></li>
            <li class='<?=$class_next?>'><a href='<?=$href_next?>'>Next</a></li>
          </ul>
        </nav >
        	<div class="dropdown container-fluid col-sm-offset-11">
        	  <button class="btn btn-default dropdown-toggle sort_button" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        	    Sort by
        	    <span class="caret"></span>
        	  </button>
        	  <ul class="dropdown-menu sort_button" role="menu" aria-labelledby="dropdownMenu1">
        	    <li role="presentation"><a role="menuitem" tabindex="-1" href="/home/order_asc">Price$-$$$</a></li>
        </nav>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="/home/order_desc">Price$$$-$</a></li>
          <!--     <li role="presentation"><a role="menuitem" tabindex="-1" href="/index/order_asc/created_at">Newest-Oldest</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="/index/order_desc/created_at">Oldest-Newest</a></li>
 -->        </ul>
          </div>
          <!-- <div class="row-fluid"> -->

<div id='display'>
</div>



          <!-- </div><!/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>


      <nav class="text-center">
      <ul class="pagination">

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
                <li class='<?=$class?>'><a href="/home/show_pagination/<?=$key?>"><?=$key?><span class="sr-only">(current)</span></a></li>
<?php
                }
            }
?>
            <li class='<?=$class_next?>'><a href='<?=$href_next?>'><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
            </ul>
        </nav>
      <footer>
        <p>&copy; Footer</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javasc======================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <a href="/admin">admin</a>
  </body>
</html>
