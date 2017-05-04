<?php
if( !defined('_VALID_MOS') && !defined('_JEXEC') ) die( 'Direct Access to ' . basename(__file__) . ' is not allowed.' );
/**
 * ps_payfast.php
 *
 * This file contains the administrator payment module configuration form code
 *
 * Copyright (c) 2008 PayFast (Pty) Ltd
 * You (being anyone who is not PayFast (Pty) Ltd) may download and use this plugin / code in your own website in conjunction with a registered and active PayFast account. If your PayFast account is terminated for any reason, you may not use this plugin / code or part thereof.
 * Except as expressly indicated in this licence, you may not use, copy, modify or distribute this plugin / code or part thereof in any way.
 * 
 * @author     Jonathan Smit
 * @link       http://www.payfast.co.za/help/virtuemart
 */
// Include files
require_once( CLASSPATH .'payment/ps_payfast.cfg.php' );
require_once( CLASSPATH .'payfast_common.inc' );
require_once( CLASSPATH .'ps_order.php' );

// Variable Initialization
$error = false;
$errors = array();
$data = array();
$orderId = '';

// Get order id (from URL)
$orderIdUrl = isset( $_GET['order_id'] ) ? $_GET['order_id'] : null;
$orderId = $orderIdUrl;

if( !$error && empty( $orderIdUrl ) )
{
	$error = true;
	$errors[] = PAYFAST_ERR_ORDER_ID_MISSING_URL;
}

//// Check that order (from URL) exists
if( !$error )
{
	// Get order from VirtueMart
	$db = new ps_DB;
	$sql  =
		"SELECT *
		FROM `#__{vm}_orders` AS a
		WHERE a.`order_id`= '". $orderIdUrl ."'";
	$db->query( $sql );

	$orderIdDb = $db->f( 'order_id' );

    // If order ID is empty
	if( empty( $orderIdDb ) )
	{
		$error = true;
		$errors[] = PAYFAST_ERR_ORDER_INVALID;
	}
}

//// Display appropriate feedback
if( !$error )
{
    // If payment status is COMPLETE
    if( $db->f( 'order_status' ) == PAYFAST_VERIFIED_STATUS )
    {
	    // Display confirmation
	    $output =
			'<img src="'. VM_THEMEURL .'images/button_ok.png" align="middle"'.
			' alt="'. $VM_LANG->_( 'VM_CHECKOUT_SUCCESS' ) .'" border="0">'.
        	'<h2>'. $VM_LANG->_( 'VM_CHECKOUT_SUCCESS' ) .'</h2>'.
			'<p>Thank you. Your payment was successful and your order has been confirmed.';
		print( $output );
    }
    elseif( $db->f( 'order_status' ) == PAYFAST_PENDING_STATUS )
    {
	    // Display confirmation
	    $output =
			'<img src="'. VM_THEMEURL .'images/button_ok.png" align="middle"'.
			' alt="'. $VM_LANG->_( 'VM_CHECKOUT_SUCCESS' ) .'" border="0">'.
        	'<h2>'. $VM_LANG->_( 'VM_CHECKOUT_SUCCESS' ) .'</h2>'.
			'<p>Thank you. Your order was successful and you will receive an'.
            ' email once your payment has been confirmed.';
		print( $output );
    }
    else
    {
    	$output =
    		'<img src="'. VM_THEMEURL .'images/button_cancel.png" align="middle"'.
			' alt="'. $VM_LANG->_( 'VM_CHECKOUT_FAILURE' ) .'" border="0">'.
        	'<h2>'. $VM_LANG->_( 'VM_CHECKOUT_FAILURE' ) .'</h2>'.
			'<p>Your payment failed, but your order has been left in a PENDING status.<br>'.
			'Please contact the store administrator(s) to rectify the problem.</p>';
		print( $output );
    }

	// Display link to order page
	$output =
		'<br>'.
		'<p><a href="'. $_SERVER['PHP_SELF'] .
		'?option=com_virtuemart&page=account.order_details&order_id='. $orderId .'">'.
 		$VM_LANG->_( 'PHPSHOP_ORDER_LINK' ) .'</a></p>';
 	print( $output );
}

//// Display error message
if( $error )
{
	$output =
		'<img src="'. VM_THEMEURL .'images/error.gif" align="middle"'.
		' alt="Errors occurred" border="0">'.
		'<h2>Errors occurred processing your request</h2>'.
		'<ul>';

	foreach( $errors as $err )
		$output .= '<li>'. $err .'</li>';

	$output .= '</ul>';

	$link = '';
	if( !empty( $orderId ) )
		$link = '<a href="'. $_SERVER['PHP_SELF'] .
			'?option=com_virtuemart&page=account.order_details&order_id='. $orderId .'">'.
			$VM_LANG->_( 'PHPSHOP_ORDER_LINK' ) .'</a>';
	else
		$link = 'See your <a href="'. $_SERVER['PHP_SELF'] .
			'?option=com_virtuemart&page=account.index">account</a> page for more information';

	$output .=
		$link .'<br>'.
		'Alternatively, contact the store administrator(s) to resolve the problem</p>';

	print( $output );
}
?>