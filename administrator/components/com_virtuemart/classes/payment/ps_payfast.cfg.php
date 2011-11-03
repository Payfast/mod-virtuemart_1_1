<?php
if( !defined( '_PF_ITN' ) && !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
 * ps_payfast.cfg.php
 *
 * This file contains the payment module configuration settings. It must be
 * writeable on the web server.
 *
 * Copyright (c) 2009-2011 PayFast (Pty) Ltd
 * 
 * LICENSE:
 * 
 * This payment module is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation; either version 3 of the License, or (at
 * your option) any later version.
 * 
 * This payment module is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public
 * License for more details.
 * 
 * @author     Jonathan Smit
 * @copyright  2009-2011 PayFast (Pty) Ltd
 * @license    http://www.opensource.org/licenses/lgpl-license.php LGPL
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