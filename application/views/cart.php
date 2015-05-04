<!--<?php var_dump($this->session->userdata('paid')) ?>-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sports Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- The required Stripe lib -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    

    <script type="text/javascript">
      // This identifies your website in the createToken call below
      Stripe.setPublishableKey('pk_test_vkhOrs7x43pQ6vk8AsbZqox7');

      var stripeResponseHandler = function(status, response) {
        var $form = $('#payment-form');

        if (response.error) {
          // Show the errors on the form
          $form.find('.payment-errors').text(response.error.message);
          $form.find('button').prop('disabled', false);
        } else {
          // token contains id, last4, and card type
          var token = response.id;
          // Insert the token into the form so it gets submitted to the server
          $form.append($('<input type="hidden" name="stripeToken" />').val(token));
          // and re-submit
          $form.get(0).submit();
        }
      };

      jQuery(function($) {
        $('#payment-form').submit(function(e) {
          var $form = $(this);

          // Disable the submit button to prevent repeated clicks
          $form.find('button').prop('disabled', true);

          Stripe.card.createToken($form, stripeResponseHandler);

          // Prevent the form from submitting with the default action
          return false;
        });
      });
    </script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      /*.form-group {
        margin-bottom: 0px;
      }*/
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

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>
    <span class="display"></span>
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
            <li><a href="">Shopping Cart(<?= $this->session->userdata('cart')['total_items'] ?>)</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>

<div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Error!</strong> <span class="payment-errors"></span> </div>
<span class="payment-success">
<?php 
if(!empty($stripe_response)) {
?> <?= $stripe_response ?>
<?php }
?>
</span>


    <div class="container">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($cart as $product)
          {
            ?>
            <tr>
              <td><?= $product['name'] ?></td>
              <td>$<?= $product['price'] ?></td>
              <form action='/cart/delete/<?= $product['id']?>' method="post">
                <td><?= $product['quantity'] ?>
                  <button type="button submit" class="glyphicon glyphicon-trash pull-right"></button>

                  <!-- <button type="button submit" class="btn btn-link pull-right">update</button>   -->
                </td>
              </form>
              <td>$<?= $product['price'] * $product['quantity'] ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div><!-- /table -->
    <p class="container text-right">Shipping: 9.99</p>
    <p class="container text-right">Sum amount: $<?= $cart['total_price'] + 9.99 ?></p>
     <div class="container">
       <a href="/"><button class="btn btn-primary pull-right" type="submit" value='submit'>Continue shopping</button></a>
     </div>
    <!--  <div class="container">
       <a href="/cart/stripe"><button class="btn btn-primary pull-right" type="submit" value='submit'>Pay</button></a>
     </div> -->
     <span class="payment-success">
     <?php 
     if($this->session->flashdata("error")) 
     {
      echo $this->session->flashdata("error");
     }
    ?>
     </span>

       <form action="/cart/post" method="POST" id="payment-form" class="form-horizontal">
       <span class="payment-errors"></span>
       <div class="row row-centered">
       <div class="col-md-4 col-md-offset-4">
       <div class="page-header">
         <h2 class="gdfg">Secure Payment Form</h2>
       </div>
       <noscript>
       <div class="bs-callout bs-callout-danger">
         <h4>JavaScript is not enabled!</h4>
         <p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
       </div>
       </noscript>
       <?php
      
     ?>
       <div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Error!</strong> <span class="payment-errors"></span> </div>
       <span class="payment-success">
       <?php if((!empty($success)) || (!empty($error))) {
     ?>  <?= $success ?>
       <?= $error ?>
       <?php
       }
       ?>
       </span>
       <fieldset>
       <!-- Form Name -->
       <legend>Shipping Details</legend>

       <!-- First Name -->
       <div class="form-group">
         <label class="col-sm-4 control-label"  for="textinput">First Name</label>
         <div class="col-sm-6">
           <input type="text" name="firstname" maxlength="70" placeholder="First Name" class="first-name form-control" value="Bob">
         </div>
       </div>

       <!-- Long  Name -->
       <div class="form-group">
         <label class="col-sm-4 control-label"  for="textinput">Last Name</label>
         <div class="col-sm-6">
           <input type="text" name="lastname" maxlength="70" placeholder="Last Name" class="last-name form-control" value="Sagat">
         </div>
       </div>

       <!-- Address -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">Address</label>
         <div class="col-sm-6">
           <input type="text" name="address" placeholder="Address" class="address form-control" value="123 Real St.">
         </div>
       </div>
       <!-- Address2 -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">Address 2</label>
         <div class="col-sm-6">
           <input type="text" name="address2" placeholder="Address 2" class="address form-control">
         </div>
       </div>
       <!-- City -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">City</label>
         <div class="col-sm-6">
           <input type="text" name="city" placeholder="City" class="city form-control" value="Cupertino">
         </div>
       </div>
       
       <!-- State -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">State</label>
         <div class="col-sm-6">
           <input type="text" name="state" maxlength="65" placeholder="State" class="state form-control" value="CA">
         </div>
       </div>
       
       <!-- Postcal Code -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">Zip code</label>
         <div class="col-sm-6">
           <input type="text" name="zip" maxlength="9" placeholder="Postal Code" class="zip form-control" value="95126">
         </div>
       </div>
       
       <!-- Form Name -->
       <legend>Billing Details</legend>
       
       <!-- First Name -->
       <div class="form-group">
         <label class="col-sm-4 control-label"  for="textinput">First Name</label>
         <div class="col-sm-6">
           <input type="text" name="bfirstname" maxlength="70" placeholder="First Name" class="first-name form-control" value="Bob">
         </div>
       </div>

       <!-- Long  Name -->
       <div class="form-group">
         <label class="col-sm-4 control-label"  for="textinput">Last Name</label>
         <div class="col-sm-6">
           <input type="text" name="blastname" maxlength="70" placeholder="Last Name" class="last-name form-control" value="Sagat">
         </div>
       </div>

       <!-- Address -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">Address</label>
         <div class="col-sm-6">
           <input type="text" name="baddress" placeholder="Address" class="address form-control" value="123 Real St.">
         </div>
       </div>
       <!-- Address2 -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">Address 2</label>
         <div class="col-sm-6">
           <input type="text" name="baddress2" placeholder="Address 2" class="address form-control">
         </div>
       </div>
       <!-- City -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">City</label>
         <div class="col-sm-6">
           <input type="text" name="bcity" placeholder="City" class="city form-control" value="Cupertino">
         </div>
       </div>
       
       <!-- State -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">State</label>
         <div class="col-sm-6">
           <input type="text" name="bstate" maxlength="65" placeholder="State" class="state form-control" value="CA">
         </div>
       </div>
       
       <!-- Postcal Code -->
       <div class="form-group">
         <label class="col-sm-4 control-label" for="textinput">Zip code</label>
         <div class="col-sm-6">
           <input type="text" name="bzip" maxlength="9" placeholder="Postal Code" class="zip form-control" value="95126">
         </div>
       </div>
       <fieldset>
         <legend>Card Details</legend>
         
         <!-- Card Holder Name -->
         <div class="form-group">
           <label class="col-sm-4 control-label"  for="textinput">Card Holder's Name</label>
           <div class="col-sm-6">
             <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name" class="card-holder-name form-control" value="Bob">
           </div>
         </div>
         
         <!-- Card Number -->
         <div class="form-group">
           <label class="col-sm-4 control-label" for="textinput">Card Number</label>
           <div class="col-sm-6">
             <input type="text" id="cardnumber" data-stripe="number" maxlength="19" placeholder="Card Number" class="card-number form-control" value="4000000000000010">
           </div>
         </div>
         
         <!-- Expiry-->
         <div class="form-group">
           <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
           <div class="col-sm-6">
             <div class="form-inline">
               <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
                 <option value="01" selected="selected">01</option>
                 <option value="02">02</option>
                 <option value="03">03</option>
                 <option value="04">04</option>
                 <option value="05">05</option>
                 <option value="06">06</option>
                 <option value="07">07</option>
                 <option value="08">08</option>
                 <option value="09">09</option>
                 <option value="10">10</option>
                 <option value="11">11</option>
                 <option value="12">12</option>
               </select>
               <span> / </span>
               <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control" value="312">
               </select>
               <script type="text/javascript">
                 var select = $(".card-expiry-year"),
                 year = new Date().getFullYear();
      
                 for (var i = 0; i < 12; i++) {
                     select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                 }
             </script> 
             </div>
           </div>
         </div>
         
         <!-- CVV -->
         <div class="form-group">
           <label class="col-sm-4 control-label" for="textinput">CVV/CVV2</label>
           <div class="col-sm-3">
             <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
           </div>
         </div>
         
         <!-- Important notice -->
         <div class="form-group">
         <div class="panel panel-success">
           <div class="panel-heading">
             <h3 class="panel-title">Important notice</h3>
           </div>
           <div class="panel-body">
             <p>Your card will be charged a total of $<?= $cart['total_price'] + 9.99 ?> after submit.</p>
             <input type="hidden" name="total_to_charge" value="<?= $cart['total_price'] + 9.99 ?>">
             <p>Your account statement will show the following booking text:
               XXXXXXX </p>
           </div>
         </div>
         
         <!-- Submit -->
         <div class="control-group">
           <div class="controls">
             <center>
               <button class="btn btn-success" type="submit">Pay Now</button>
             </center>
           </div>
         </div>
       </fieldset>
     </form>
    <!-- Le javasc======================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  

  </body>
</html>

