<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
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

/**
 * ps_payfast
 */
class ps_payfast
{
    var $classname = 'ps_payfast';
    var $payment_code = 'PF';

    /**
     * show_configuration
     *
     * Show all configuration parameters for this payment method
     *
     * @returns boolean False when the Payment method has no configration
     */
    function show_configuration()
	{
		// Variable initialization
        global $VM_LANG;
        $db = new ps_DB();

        // Read current Configuration
        include_once( CLASSPATH .'payment/'. $this->classname .'.cfg.php' );

        // Display configuration form
    ?>
        <p style="text-align: left;">
        Please <a href="http://www.payfast.co.za/user/register" target="_blank">register</a> on <a href="http://www.payfast.co.za" target="_blank">PayFast</a> to use this module.
        </p>

        <p style="text-align: left;">
        Your <em>Merchant ID</em> and <em>Merchant Key</em> are available on your <a href="http://www.payfast.co.za/acc/integration" target="_blank">Integration page</a> on the PayFast website.
        </p>

        <table class="adminform">
            <!-- Transaction Server -->
            <tr class="row0">
            	<td><strong>Transaction Server</strong></td>
                <td>
                    <select name="PAYFAST_SERVER" class="inputbox" >
                    <option <?php if (PAYFAST_SERVER == 'TEST') echo "selected=\"selected\""; ?> value="TEST">TEST</option>
                    <option <?php if (PAYFAST_SERVER != 'TEST') echo "selected=\"selected\""; ?> value="LIVE">LIVE</option>
                    </select>
                </td>
                <td>
                Select the PayFast server to use
                </td>
            </tr>
            <!-- Merchant ID -->
            <tr class="row1">
            	<td><strong>Merchant ID</strong></td>
                <td>
                    <input type="text" name="PAYFAST_MERCHANT_ID" class="inputbox" style="width: 180px;" value="<?php  echo PAYFAST_MERCHANT_ID ?>">
                </td>
                <td>Your Merchant ID from PayFast</td>
            </tr>
            <!-- Merchant Key -->
            <tr class="row0">
                <td><strong>Merchant Key</strong></td>
    			<td>
    				<input type="text" name="PAYFAST_MERCHANT_KEY" class="inputbox" style="width: 180px;" value="<?php  echo PAYFAST_MERCHANT_KEY ?>">
                </td>
                <td>Your Merchant Key from PayFast</td>
            </tr>
    		<!-- Order Status - Successful -->
            <tr class="row0">
                <td><strong>Order Status for Successful Payments</strong></td>
                <td>
                    <select name="PAYFAST_VERIFIED_STATUS" class="inputbox" >
                    <?php
                    $q = "SELECT order_status_name,order_status_code FROM #__{vm}_order_status ORDER BY list_order";
                    $db->query($q);
                    $order_status_code = Array();
                    $order_status_name = Array();

                    while( $db->next_record() )
    				{
                    	$order_status_code[] = $db->f( 'order_status_code' );
    					$order_status_name[] = $db->f( 'order_status_name' );
                    }
                    for( $i = 0; $i < sizeof( $order_status_code ); $i++ )
    				{
    					echo "<option value=\"" . $order_status_code[$i];
    					if (PAYFAST_VERIFIED_STATUS == $order_status_code[$i])
    						echo "\" selected=\"selected\">";
    					else
    						echo "\">";
    					echo $order_status_name[$i] . "</option>\n";
                    }
    				?>
    				</select>
                </td>
                <td>Status to use when payment has been confirmed</td>
            </tr>
            <!-- Order Status - Pending -->
            <tr class="row1">
                <td><strong>Order Status for Pending Payments</strong></td>
                <td>
                    <select name="PAYFAST_PENDING_STATUS" class="inputbox" >
                    <?php
                    for( $i = 0; $i < sizeof( $order_status_code ); $i++ )
    				{
    					echo "<option value=\"" . $order_status_code[$i];
    					if (PAYFAST_PENDING_STATUS == $order_status_code[$i])
    						echo "\" selected=\"selected\">";
    					else
    						echo "\">";
    					echo $order_status_name[$i] . "</option>\n";
                    }
    				?>
                    </select>
                </td>
                <td>Status to use for pending/incomplete payments</td>
            </tr>
            <!-- Order Status - Failed -->
            <tr class="row1">
                <td><strong>Order Status for Failed Payments</strong></td>
                <td>
                    <select name="PAYFAST_INVALID_STATUS" class="inputbox" >
                    <?php
    				for( $i = 0; $i < sizeof( $order_status_code ); $i++ )
    				{
    					echo "<option value=\"" . $order_status_code[$i];
    					if (PAYFAST_INVALID_STATUS == $order_status_code[$i])
    						echo "\" selected=\"selected\">";
    					else
    						echo "\">";
    					echo $order_status_name[$i] . "</option>\n";
                    }
    				?>
                    </select>
                </td>
                <td>Status to use for failed/cancelled payments</td>
            </tr>
        	<!-- Debugging -->
            <tr class="row0">
            	<td><strong>Debugging?</strong></td>
                <td>
                    <select name="PAYFAST_DEBUG" class="inputbox" >
                    <option <?php if (PAYFAST_DEBUG == '1') echo "selected=\"selected\""; ?> value="1">On</option>
                    <option <?php if (PAYFAST_DEBUG != '1') echo "selected=\"selected\""; ?> value="0">Off</option>
                    </select>
                </td>
                <td>
                Whether debugging is on or off?
                </td>
            </tr>
            <!-- Debug Email -->
            <tr class="row0">
            	<td><strong>Debug email address</strong></td>
    			<td>
    				<input type="text" name="PAYFAST_DEBUG_EMAIL" class="inputbox" style="width: 180px;" value="<?php  echo PAYFAST_DEBUG_EMAIL ?>">
                </td>
                <td>
                Email address where debug emails are sent
                </td>
            </tr>
        </table>
    <?php
    }

	/**
     * has_configuration
     */
    function has_configuration()
	{
      // return false if there's no configuration
      return true;
	}

  	/**
	 * configfile_writeable
	 *
	 * Returns the "is_writeable" status of the configuration file
	 *
	 * @param void
	 * @returns boolean True when the configuration file is writeable, false when not
	 */
	function configfile_writeable()
	{
		return is_writeable( CLASSPATH .'payment/'. $this->classname .'.cfg.php' );
	}

	/**
	 * configfile_readable
	 *
	 * Returns the "is_readable" status of the configuration file
	 *
	 * @param void
	 * @returns boolean True when the configuration file is readable, false when not
	 */
	function configfile_readable()
	{
		return is_readable( CLASSPATH .'payment/'. $this->classname .'.cfg.php' );
	}

	/**
	 * write_configuration
	 *
	 * Writes the configuration file
	 *
	 * @param array An array of objects
	 * @returns boolean True when writing was successful
	 */
	function write_configuration( &$d )
	{
	    // If payment method is not newly added
        // - without this, errors would be displayed
	    if( isset( $d['PAYFAST_SERVER'] ) )
	    {
    		// Define the configuration variables
    		$my_config_array = array(
                "PAYFAST_SERVER" => $d['PAYFAST_SERVER'],
    			"PAYFAST_MERCHANT_ID" => $d['PAYFAST_MERCHANT_ID'],
    			"PAYFAST_MERCHANT_KEY" => $d['PAYFAST_MERCHANT_KEY'],
    			"PAYFAST_VERIFIED_STATUS" => $d['PAYFAST_VERIFIED_STATUS'],
    			"PAYFAST_PENDING_STATUS" => $d['PAYFAST_PENDING_STATUS'],
    			"PAYFAST_INVALID_STATUS" => $d['PAYFAST_INVALID_STATUS'],
    			"PAYFAST_DEBUG" => $d['PAYFAST_DEBUG'],
    			"PAYFAST_DEBUG_EMAIL" => $d['PAYFAST_DEBUG_EMAIL'],
    		);

    		// Set the initial content of the file
    		$config =
    			"<?php\n".
    			"if( !defined( '_PF_ITN' ) && !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) )".
                " die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );\n".
    			"/**\n".
     			" * ps_payfast.cfg.php\n".
     			" *\n".
     			" * This file contains the payment module configuration settings. It must be\n".
    			" * writeable on the web server.\n".
     			" *\n".
     			" * @copyright PayFast (Pty) Ltd � 2009\n".
     			" */\n\n";

    		// Generate the config statements
    		foreach( $my_config_array as $key => $value )
    			$config .= "define( '$key', '$value' );\n";

    		$config .= "?>";

    		// Write the configuration to file
    		if( $fp = fopen( CLASSPATH .'payment/'. $this->classname .'.cfg.php', "w" ) )
    		{
    			fputs( $fp, $config, strlen( $config ) );
    			fclose( $fp );
    			return true;
    		}
    		else
    			return false;
    	}
	}

	/**
	 * process_payment
	 *
	 * @returns boolean True
	 */
	function process_payment( $order_number, $order_total, &$d )
	{
		return true;
	}
}