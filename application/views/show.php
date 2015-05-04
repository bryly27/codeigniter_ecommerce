
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

      img {
        display: block;
        /*margin-left: auto;
        margin-right: auto;*/
        border: 1px solid black;
      }
      .inline_angle_img {
        display: inline-block;
        margin-top: 2px;
        margin-left: auto;
        margin-right: auto;
      }
      #similar_footer {
        margin-left: 0;
        padding-left: 0;
      }
      .similar_info {
        display: inline-block;
      }
      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }


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
          <a class="navbar-brand" href="/">Shoe Store</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/cart">Shopping Cart(<?= $this->session->userdata('cart')['total_items'] ?>)</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span5">
            <a href="/home">Go back</a>
<?php

  foreach ($details as $detail)
  { ?>
    <h2><?= $detail['name']; ?></h2>
    <img src="<?= $detail['photo'] ?>" alt="" width="500px"> <!--Main image for the product shown-->

           <!--Main image for the product shown-->
            <!--Thumbnails for different angles of the product-->
            <!-- <img class = "inline_angle_img" src="" alt="" width="50px" height="50px">
            <img class = "inline_angle_img" src="" alt="" width="50px" height="50px">
            <img class = "inline_angle_img" src="" alt="" width="50px" height="50px">
            <img class = "inline_angle_img" src="" alt="" width="50px" height="50px">
            <img class = "inline_angle_img" src="" alt="" width="50px" height="50px"> -->
        </div><!--/span-->
        <div class="span7">


          <div class="row-fluid">
            <div class="span9">
              <h2></h2> <!--This H2 is empty to for the P below to be aligned to the image -->
              <h3><?= $detail['description'] ?></h3>
              <h3>$<?= $detail['price'] ?></h3>
            </div><!--/span-->
          </div><!--/row-->

          <div class="row-fluid">
          <form action="" method="post">
          <!-- This might need to be moved to the FORM in the next div -->
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                Choose a color
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?= $detail['color'] ?></a></li>
              </ul>
            </div>
          </form>
          </div>

<?php
  }
?>


          <div class="row-fluid">
          <form action="/cart/addToCart" method="post">
            <div class="input-group-lg span2">
              <input type='number' min='0' max='10' size='10' id='numberinput' name='quantity' value='0' class="form-control">
              <!-- <span class="input-group-addon"></span> -->
            </div>
            <input type='hidden' name='action' value='add_to_cart'>
            <input type='hidden' name='prod_id' value='<?= $detail['id'] ?>'>
            <button class="btn btn-lg btn-primary" type="submit" value='submit'>Add to cart</button>
          </form>
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <footer class="fixed bottom">
      <div class="container span12" id="similar_footer">
        <h3>Similar items</h3>
<?php
  foreach ($similars as $similar)
  { ?>
    <div class="similar_info">
      <a href='/detail/index/<?= $similar['id'] ?>'>
          <img class = "inline_angle_img" src="<?= $similar['photo'] ?>" alt="" width="100px" height="100px">
        </a>
    </div>
<?php
  }

?>

      </div>

      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javasc======================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>


  </body>
</html>
