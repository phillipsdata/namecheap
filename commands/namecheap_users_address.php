<?php
/**
 * Namecheap User Address Management
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap.commands
 */
class NamecheapUsersAddress {
	
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
	 * Creates a new address for the user
	 *
	 * @param array $vars An array of input params including:
	 * 	- AddressName Address name to create
	 * 	- DefaultYN Possible values are 0 and 1.If the value of this parameter is set to 1, the address is set as default address for the user.
	 * 	- FirstName First name of the user
	 * 	- LastName Last name of the user
	 * 	- JobTitle Job designation of the user
	 * 	- Organization Organization of the user
	 * 	- Address1 StreetAddress1 of the user
	 * 	- Address2 StreetAddress2 of the user
	 * 	- City City of the user
	 * 	- StateProvince State/Province name of the user
	 * 	- StateProvinceChoice State/Province choice of the user
	 * 	- Zip Zip/Postal code of the user
	 * 	- Country Two letter country code of the user
	 * 	- Phone Phone number in the format +NNN.NNNNNNNNNN
	 * 	- Fax Fax number in the format +NNN.NNNNNNNNNN
	 * 	- PhoneExt PhoneExt of the user
	 * 	- EmailAddress Email address of the user
	 * @return NamecheapResponse
	 */
	public function create(array $vars) {
		return $this->api->submit("namecheap.users.address.create", $vars);
	}
	
	/**
	 * Creates a new address for the user
	 *
	 * @param array $vars An array of input params including:
	 * 	- AddressId The unique address ID to update
	 * 	- AddressName Address name to create
	 * 	- DefaultYN Possible values are 0 and 1.If the value of this parameter is set to 1, the address is set as default address for the user.
	 * 	- FirstName First name of the user
	 * 	- LastName Last name of the user
	 * 	- JobTitle Job designation of the user
	 * 	- Organization Organization of the user
	 * 	- Address1 StreetAddress1 of the user
	 * 	- Address2 StreetAddress2 of the user
	 * 	- City City of the user
	 * 	- StateProvince State/Province name of the user
	 * 	- StateProvinceChoice State/Province choice of the user
	 * 	- Zip Zip/Postal code of the user
	 * 	- Country Two letter country code of the user
	 * 	- Phone Phone number in the format +NNN.NNNNNNNNNN
	 * 	- Fax Fax number in the format +NNN.NNNNNNNNNN
	 * 	- PhoneExt PhoneExt of the user
	 * 	- EmailAddress Email address of the user 
	 * @return NamecheapResponse
	 */
	public function update(array $vars) {
		return $this->api->submit("namecheap.users.address.update", $vars);
	}
	
	/**
	 * Creates a new address for the user
	 *
	 * @param array $vars An array of input params including:
	 * 	- AddressId The unique AddressID to delete
	 * @return NamecheapResponse
	 */
	public function delete(array $vars) {
		return $this->api->submit("namecheap.users.address.delete", $vars);
	}
	
	/**
	 * Creates a new address for the user
	 *
	 * @return NamecheapResponse
	 */
	public function getList() {
		return $this->api->submit("namecheap.users.address.getList");
	}
	
	/**
	 * Creates a new address for the user
	 *
	 * @param array $vars An array of input params including:
	 * 	- AddressId The unique addressID
	 * @return NamecheapResponse
	 */
	public function getInfo(array $vars) {
		return $this->api->submit("namecheap.users.address.getInfo", $vars);
	}
	
	/**
	 * Creates a new address for the user
	 *
	 * @param array $vars An array of input params including:
	 * 	- AddressId The unique addressID to set default
	 * @return NamecheapResponse
	 */
	public function setDefault(array $vars) {
		return $this->api->submit("namecheap.users.address.setDefault", $vars);
	}
}
?>