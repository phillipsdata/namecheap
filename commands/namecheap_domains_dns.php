<?php
/**
 * Namecheap DNS Management
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap.commands
 */
class NamecheapDomainsDns {
	
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
	 * Sets domain to use our default DNS servers. Required for free services
	 * like Host record management, URL forwarding, email forwarding, dynamic
	 * dns and other value added services.
	 *
	 * @param array $vars An array of input params including:
	 *	- SLD SLD of the DomainName
	 *	- TLD TLD of the DomainName
	 * @return NamecheapResponse
	 */
	public function setDefault(array $vars) {
		return $this->api->submit("namecheap.domains.dns.setDefault", $vars);
	}

	/**
	 * Sets domain to use custom DNS servers. NOTE: Services like URL forwarding,
	 * Email forwarding, Dynamic DNS will not work for domains using custom
	 * nameservers.
	 *
	 * @param array $vars An array of input params including:
	 *	- SLD SLD of the DomainName
	 *	- TLD TLD of the DomainName
	 *	- Nameservers A comma-separated list of nameservers to be associated with this domain
	 * @return NamecheapResponse
	 */	
	public function setCustom(array $vars) {
		return $this->api->submit("namecheap.domains.dns.setCustom", $vars);		
	}
	
	/**
	 * Gets a list of DNS servers associated with the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 *	- SLD SLD of the DomainName
	 *	- TLD TLD of the DomainName
	 * @return NamecheapResponse
	 */
	public function getList(array $vars) {
		return $this->api->submit("namecheap.domains.dns.getList", $vars);
	}
	
	/**
	 * Retrieves DNS host record settings for the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 *	- SLD SLD of the DomainName to getHosts
	 *	- TLD TLD of the DomainName to getHosts
	 * @return NamecheapResponse
	 */
	public function getHosts(array $vars) {
		return $this->api->submit("namecheap.domains.dns.getHosts", $vars);
	}
	
	/**
	 * Sets DNS host records settings for the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 *	- SLD SLD of the DomainName to setHosts 
	 *	- TLD TLD of the DomainName to setHosts
	 *	- HostName[1..n] Sub-domain/hostname to create the record for 
	 *	- RecordType[1..n] Possible values A, AAAA, CNAME, MX, MXE, TXT, URL, URL301, FRAME 
	 *	- Address[1..n] Possible values are URL or IP address. The value for this parameter is based on RecordType. 
	 *	- MXPref[1..n] MX preference for host. Applicable for MX records only. 
	 *	- EmailType Possible values are MXE,MX,FWD,OX 
	 *	- TTL[1..n] Time to live for all record types.Possible values: any value between 60 to 60000 
	 * @return NamecheapResponse
	 */
	public function setHosts(array $vars) {
		return $this->api->submit("namecheap.domains.dns.setHosts", $vars);
	}
	
	/**
	 * Gets email forwarding settings for the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 *	- DomainName Domain name to get settings
	 * @return NamecheapResponse
	 */
	public function getEmailForwarding(array $vars) {
		return $this->api->submit("namecheap.domains.dns.getEmailForwarding", $vars);
	}
	
	/**
	 * Sets email forwarding for a domain name.
	 *
	 * @param array $vars An array of input params including:
	 *	- DomainName Domain name to set Emailforwarding
	 *	- MailBox[1..n] MailBox for which you wish to set email forwarding. For example:example@namecheap.com
	 *	- ForwardTo[1..n] Email address to forwardto.For example:example@gmail.com
	 * @return NamecheapResponse
	 */
	public function setEmailForwarding(array $vars) {
		return $this->api->submit("namecheap.domains.dns.setEmailForwarding", $vars);
	}
}
?>