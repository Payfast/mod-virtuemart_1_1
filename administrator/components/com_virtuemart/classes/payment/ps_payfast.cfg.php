<?php
if( !defined( '_PF_ITN' ) && !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 * ps_payfast.cfg.php
 *
 * This file contains the payment module configuration settings. It must be
 * writeable on the web server.
 *
 * Copyright (c) 2008 PayFast (Pty) Ltd
 * You (being anyone who is not PayFast (Pty) Ltd) may download and use this plugin / code in your own website in conjunction with a registered and active PayFast account. If your PayFast account is terminated for any reason, you may not use this plugin / code or part thereof.
 * Except as expressly indicated in this licence, you may not use, copy, modify or distribute this plugin / code or part thereof in any way.
 * 
 * @author     Jonathan Smit
 * @link       http://www.payfast.co.za/help/virtuemart
 */

define( 'PAYFAST_SERVER', 'TEST' );
define( 'PAYFAST_MERCHANT_ID', '' );
define( 'PAYFAST_MERCHANT_KEY', '' );
define( 'PAYFAST_VERIFIED_STATUS', 'C' );
define( 'PAYFAST_PENDING_STATUS', 'P' );
define( 'PAYFAST_INVALID_STATUS', 'X' );
define( 'PAYFAST_DEBUG', '0' );
define( 'PAYFAST_DEBUG_EMAIL', '' );
?>