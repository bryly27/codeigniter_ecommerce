<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>Sports Store</title>
 <!-- jQuery is used only for this example; it isn't required to use Stripe -->
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
</head>
<body>

<div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Error!</strong> <span class="payment-errors"></span> </div>
<span class="payment-success">
<?php if(!empty($view_data)){
?> <?= $stripe_response ?>
<?php }
?>
</span>
  <h1>Charge $10 with Stripe</h1>
 
  <form action="/cart/post" method="POST" id="payment-form">
    <span class="payment-errors"></span>
 
    <div class="form-row">
      <label>
        <span>Card Number</span>
        <input type="text" size="20" data-stripe="number" value="4000000000000119"/>
      </label>
    </div>
 
    <div class="form-row">
      <label>
        <span>CVC</span>
        <input type="text" size="4" data-stripe="cvc" value="123"/>
      </label>
    </div>
 
    <div class="form-row">
      <label>
        <span>Expiration (MM/YYYY)</span>
        <input type="text" size="2" data-stripe="exp-month" value="09" />
      </label>
      <span> / </span>
      <input type="text" size="4" data-stripe="exp-year" value="2019" />
    </div>
 
    <button type="submit">Submit Payment</button>
  </form>
</body>
</html>