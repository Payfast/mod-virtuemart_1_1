<?php
/**
 * Copyright (c) 2008 PayFast (Pty) Ltd
 * You (being anyone who is not PayFast (Pty) Ltd) may download and use this plugin / code in your own website in conjunction with a registered and active PayFast account. If your PayFast account is terminated for any reason, you may not use this plugin / code or part thereof.
 * Except as expressly indicated in this licence, you may not use, copy, modify or distribute this plugin / code or part thereof in any way.
 * 
 * @author     Jonathan Smit
 * @link       http://www.payfast.co.za/help/virtuemart
 */

// Include the configuration file
require_once( CLASSPATH .'payment/ps_payfast.cfg.php' );

// Include the PayFast common file
define( 'PF_DEBUG', ( PAYFAST_DEBUG ? true : false ) );
require_once( CLASSPATH .'payfast_common.inc' );

// Variable determination
global $vendor_name;
$form_action_url = '';

// Use appropriate merchant identifiers
// Live
if( PAYFAST_SERVER == 'LIVE' )
{
    $merchantId = PAYFAST_MERCHANT_ID; 
    $merchantKey = PAYFAST_MERCHANT_KEY;
    $form_action_url = 'https://www.payfast.co.za/eng/process';
}
// Sandbox
else
{
    $merchantId = '10000100';
    $merchantKey = '46f0cd694581a'; 
    $form_action_url = 'https://sandbox.payfast.co.za/eng/process';
}

// Create URLs
$returnUrl = SECUREURL . 'index.php?option=com_virtuemart&page=checkout.payfast&order_id='. $db->f( 'order_id' );
$cancelUrl = SECUREURL . 'index.php?option=com_virtuemart&page=account.order_details&order_id='. $db->f( 'order_id' );
$notifyUrl = SECUREURL . 'administrator/components/com_virtuemart/payfast_notify.php';

// Create description
$description = '';

// For future use
//$taxTotal = $db->f("order_tax") + $db->f("order_shipping_tax");
//$discountTotal = $db->f("coupon_discount") + $db->f("order_discount");
//$total = $db->f("order_shipping") + $db->f( 'order_subtotal' );

// Construct variables for post
$post_variables = array(
	//// Merchant details
    'merchant_id' => $merchantId,
	'merchant_key' => $merchantKey,
	'return_url' => $returnUrl,
	'cancel_url' => $cancelUrl,
	'notify_url' => $notifyUrl,
	
    //// Customer details
    'name_first' => substr( $dbbt->f('first_name'), 0, 100 ),
	'name_last' => substr( $dbbt->f('last_name'), 0, 100 ),
	'email_address' => substr( $dbbt->f('user_email'), 0, 255 ),
	
    //// Item details
    'item_name' => $vendor_name .' purchase, Order #'. $db->f("order_id"),
	'item_description' => $description,
	'amount' => number_format( $db->f( 'order_total' ), 2, '.', '' ),
	'm_payment_id' => $db->f( 'order_id' ),
	'currency_code' => $_SESSION['vendor_currency'],
	'custom_str1' => $db->f( 'order_number' ),
    
    // Other details
    'user_agent' => PF_USER_AGENT,
	);

// Output the form
$output = '<form id="payfast_form" name="payfast_form" action="'. $form_action_url .'" method="post">';
foreach( $post_variables as $name => $value )
	$output .= '<input type="hidden" name="'. $name .'" value="'. htmlspecialchars( $value ) .'">';

$pay_msg = 'If you are not automatically redirected, please click the image below to Pay with Payfast<br>';

if( isset( $_REQUEST['page'] ) && ( $_REQUEST['page'] == "account.order_details" ) )
{
    $pay_msg =
        "This order is <b>PENDING</b> as payment has not yet been received.<br>".
        "Please click the image below to make payment<br>";
}

$output .= $pay_msg;

$output .=
	'<input type="image" src="https://www.payfast.co.za/images/logo_small.png"'.
	' name="submit" alt="PayFast" title="Pay with PayFast">'.
	'</form>';

// Post form to PayFast (If not on the "Order Details" Page)
if( isset( $_REQUEST['page'] ) && ( $_REQUEST['page'] != "account.order_details" ) )
{
	$output .=
		'<script type="text/javascript">'.
    	'document.getElementById( "payfast_form" ).submit();'.
    	'</script>';
}

print( $output );
?>