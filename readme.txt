PayFast VirtueMart v1.1 Module v1.21 for VirtueMart v1.1.7
----------------------------------------------------------
Copyright (c) 2008 PayFast (Pty) Ltd
You (being anyone who is not PayFast (Pty) Ltd) may download and use this plugin / code in your own website in conjunction with a registered and active PayFast account. If your PayFast account is terminated for any reason, you may not use this plugin / code or part thereof.
Except as expressly indicated in this licence, you may not use, copy, modify or distribute this plugin / code or part thereof in any way.
INTEGRATION:
1. Unzip the module to a temporary location on your computer
2. Copy the “administrator” folder in the archive to your base “joomla” folder
- This should NOT overwrite any existing files or folders and merely supplement them with the PayFast files
- This is however, dependent on the FTP program you use
3. Login to the Joomla Administrator console
4. Using the main menu, navigate to Components -> VirtueMart
5. Using the VirtueMart menu, navigate to Store -> Add Payment Method
6. Enter the following details in the “Payment Method Form” tab:
- Active? =
- Payment Method Name = “PayFast”
- Code = “PF”
- Payment class name = “ps_payfast”
- Payment method type = “HTML-Form based (e.g. PayPal)”
- (Leave all other fields as they are)
7. Click Save
8. Click on the newly added “PayFast” method in the payment methods list
9. Click on the Configuration tab
10. Copy the contents of the “payment_extra_info.php” file into the “Payment Extra Info” field
11. Click Save
12. The module is now ready to be tested with the Sandbox. Use these merchant identifiers when using the test server:
- Merchant ID: 10000100
- Merchant Key: 46f0cd694581a
13. To test with the sandbox, use the following login credentials when redirected to the PayFast site:
- Username: sbtu01@payfast.co.za
- Password: clientpass

I”m ready to go live! What do I do?
In order to make the module “LIVE”, follow the instructions below:

VirtueMart 1.1.x

1. Login to the Joomla Administrator console
2. Using the main menu, navigate to Components -> VirtueMart
3. Using the VirtueMart menu, navigate to Store -> List Payment Methods
4. Click on the “PayFast” payment method
5. Click on the “Configuration” tab
6. Change the configuration values as below:
7. Transaction Server = “LIVE”
8. Merchant ID = Integration page>
9. Merchant Key = Integration page>
10. (Change the other fields as per your preferences)
11. Click Save


******************************************************************************
*                                                                            *
*    Please see the URL below for all information concerning this module:    *
*                                                                            *
*                  https://www.payfast.co.za/shopping-carts/virtuemart/      *
*                                                                            *
******************************************************************************