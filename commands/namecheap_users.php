<?php
/**
 * Namecheap User Management
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap.commands
 */
class NamecheapUsers {
	
	/**
	 * @var NamecheapApi
	 */
	private $api;
		
	/**
	 * Sets the API to use for communication
	 *
	 * @param NamecheapApi $api The API to use for communication
	 */
	public function __construct(NamecheapApi $api) {
		$this->api = $api;
	}
	
	/**
	 * Creates a new user account at NameCheap under this ApiUser. NOTE: Use
	 * the global parameter "UserName" to specify new user value.
	 *
	 * @param array $vars An array of input params including:
	 * 	- NewUserName Username for the new user account 
	 * 	- NewUserPassword Password for the new user account 
	 * 	- EmailAddress Email address of the user 
	 * 	- IgnoreDuplicateEmailAddress By default, it ignores to check if the email address is already in use.
	 * 	- FirstName First name of the user 
	 * 	- LastName Last name of the user 
	 * 	- AcceptTerms Terms of agreement. The Value should be 1 for user account creation. 
	 * 	- AcceptNews Possible values are 0 and 1. Value should be 1 if the user wants to recieve newsletters else it should be 0. 
	 * 	- JobTitle Job designation of the user 
	 * 	- Organization Organization of the user 
	 * 	- Address1 StreetAddress1 of the user 
	 * 	- Address2 StreetAddress2 of the user 
	 * 	- City City of the user 
	 * 	- StateProvince State/Province name of the user
	 * 	- Zip Zip/Postal code of the user 
	 * 	- Country Two letter country code of the user 
	 * 	- Phone Phone number in the format +NNN.NNNNNNNNNN 
	 * 	- PhoneExt PhoneExt of the user 
	 * 	- Fax Fax number in the format +NNN.NNNNNNNNNN 
	 * @return NamecheapResponse
	 */
	public function create(array $vars) {
		return $this->api->submit("namecheap.users.create", $vars);
	}

	/**
	 * Returns pricing information for a requested product type.
	 *
	 * @param array $vars An array of input params including:
	 * 	- ProductType Product Type to get pricing information, possible values:
	 * 		- DOMAIN
	 * 		- SSLCERTIFICATE
	 * 		- WHOISGUARD
	 * 	- ProductCategory Specific category within a product type, possible values:
	 * 		- If ProductType is DOMAIN: REGISTER,RENEW,REACTIVATE,TRANSFER,WBL
	 * 		- If ProductType is SSLCERTIFICATE: COMODO,GEOTRUST
	 * 		- If ProductType is WHOISGUARD: WHOISGUARD
	 * 	- PromotionCode Promotional (coupon) code for the user 
	 * @return NamecheapResponse
	 */
	public function getPricing(array $vars) {
		return $this->api->submit("namecheap.users.getPricing", $vars);
	}
	
	/**
	 * Gets information about fund in the user's account.This method returns
	 * the following information: Available Balance, Account Balance,
	 * Earned Amount, Withdrawable Amount and Funds Required for AutoRenew.
	 * NOTE: If a domain setup with automatic renewal is expiring within the
	 * next 90 days, the "FundsRequiredForAutoRenew" attribute shows the amount
	 * needed in your NameCheap account to complete auto renewal.
	 *
	 * @return NamecheapResponse
	 */
	public function getBalances() {
		return $this->api->submit("namecheap.users.getBalances");
	}
	
	/**
	 * Changes password of the particular user's account.
	 *
	 * @param array $vars An array of input params including:
	 * 	- OldPassword Old password of the user
	 * 	- NewPassword New password of the user
	 * @return NamecheapResponse
	 */
	public function changePassword(array $vars) {
		return $this->api->submit("namecheap.users.changePassword", $vars);
	}
	
	/**
	 * Updates user account information for the particular user.
	 *
	 * @param array $vars An array of input params including:
	 * 	- JobTitle Job designation of the user 
	 * 	- Organization Organization of the user 
	 * 	- Address1 StreetAddress1 of the user 
	 * 	- Address2 StreetAddress2 of the user 
	 * 	- City City of the user 
	 * 	- StateProvince State/Province name of the user
	 * 	- Zip Zip/Postal code of the user 
	 * 	- Country Two letter country code of the user
	 * 	- EmailAddress Email address of the user
	 * 	- Phone Phone number in the format +NNN.NNNNNNNNNN 
	 * 	- PhoneExt PhoneExt of the user 
	 * 	- Fax Fax number in the format +NNN.NNNNNNNNNN 
	 * @return NamecheapResponse
	 */
	public function update(array $vars) {
		return $this->api->submit("namecheap.users.update", $vars);
	}
	
	/**
	 * Creates a request to add funds through a credit card.
	 *
	 * @param array $vars An array of input params including:
	 * 	- Username Username to add funds to 
	 * 	- PaymentType Possible value: Creditcard 
	 * 	- Amount Amount to add in USD 
	 * 	- ReturnUrl A valid URL where the user should be redirected once payment is complete
	 * @return NamecheapResponse
	 */
	public function createAddFundsRequest(array $vars) {
		return $this->api->submit("namecheap.users.createAddFundsRequest", $vars);
	}
	
	/**
	 * Gets the status of add funds request.
	 *
	 * @param array $vars An array of input params including:
	 * 	- TokenId The Unique ID that you received after calling namecheap.users.createaddfundsrequest method 
	 * @return NamecheapResponse
	 */
	public function getAddFundsStatus(array $vars) {
		return $this->api->submit("namecheap.users.getAddFundsStatus", $vars);
	}
	
	/**
	 * Validates the username and password of user accounts you have created
	 * using the API command namecheap.users.create. You cannot use this
	 * command to validate user accounts created directly at namecheap.com
	 *
	 * @param array $vars An array of input params including:
	 * 	- Password Password of the user account
	 * @return NamecheapResponse
	 */
	public function login(array $vars) {
		return $this->api->submit("namecheap.users.login", $vars);
	}
	
	/**
	 * When you call this API, a link to reset password will be emailed to the
	 * end user's profile email id.The end user needs to click on the link to
	 * reset password.
	 *
	 * @param array $vars An array of input params including:
	 * 	- FindBy Possible values:EMAILADDRESS, DOMAINNAME,USERNAME
	 * 	- FindByValue The username/email address/domain of the user. 
	 * 	- EmailFromName Enter a different value to overwrite the default value 
	 * 	- EmailFrom Enter a different value to overwrite the default value
	 * 	- URLPattern Enter a different URL to overwrite namecheap.com.
	 * @return NamecheapResponse
	 */
	public function resetPassword(array $vars) {
		return $this->api->submit("namecheap.users.resetPassword", $vars);
	}
}
?>