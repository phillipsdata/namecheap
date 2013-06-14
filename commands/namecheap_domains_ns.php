<?php
/**
 * Namecheap Nameserver Management
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap.commands
 */
class NamecheapDomainsNs {
	
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
	 * Creates a new nameserver.
	 *
	 * @param array $vars An array of input params including:
	 * 	- SLD SLD of domain
	 * 	- TLD TLD of domain
	 * 	- Nameserver Nameserver to create
	 * 	- IP Nameserver IP address
	 * @return NamecheapResponse
	 */
	public function create(array $vars) {
		return $this->api->submit("namecheap.domains.ns.create", $vars);
	}

	/**
	 * Deletes a nameserver associated with the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- SLD SLD of domain
	 * 	- TLD TLD of domain
	 * 	- Nameserver Nameserver for deletion
	 * @return NamecheapResponse
	 */	
	public function delete(array $vars) {
		return $this->api->submit("namecheap.domains.ns.delete", $vars);
	}
	
	/**
	 * Retrieves information about a registered nameserver.
	 *
	 * @param array $vars An array of input params including:
	 * 	- SLD SLD of domain
	 * 	- TLD TLD of domain
	 * 	- Nameserver Nameserver
	 * @return NamecheapResponse
	 */
	public function getInfo(array $vars) {
		return $this->api->submit("namecheap.domains.ns.getInfo", $vars);
	}
	
	/**
	 * Updates the IP address of a registered nameserver.
	 *
	 * @param array $vars An array of input params including:
	 * 	- SLD SLD of domain
	 * 	- TLD TLD of domain
	 * 	- Nameserver Nameserver Name
	 * 	- OldIP Existing IP address
	 * 	- IP New IP address
	 * @return NamecheapResponse
	 */
	public function update(array $vars) {
		return $this->api->submit("namecheap.domains.ns.update", $vars);
	}
}
?>