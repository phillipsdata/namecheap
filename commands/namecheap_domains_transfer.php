<?php
/**
 * Namecheap Domain Transfer Management
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap.commands
 */
class NamecheapDomainsTransfer {
	
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
	 * Transfers a domain to NameCheap. You can only transfer .com, .net, .org,
	 * .info, .biz, .us, .ca, .cc, .cn, .com.cn, .net.cn, .org.cn, .co.uk,
	 * .org.uk .me.uk and .mobi domains at this time.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName Domain name to transfer
	 * 	- Years Number of years to renew after a successful transfer
	 * 	- EPPCode The EPPCode is required for transferring .com, .net, .de, .org, .biz, .info, .mobi, .cn , .co, .ca and .us domains only.
	 * 	- PromotionCode Promotional (coupon) code for transfer
	 * 	- AddFreeWhoisguard Adds free Whoisguard for the domain
	 * 	- WGEnable Promotional (coupon) code for transfer
	 * @return NamecheapResponse
	 */
	public function create(array $vars) {
		if (isset($vars['EPPCode']) && substr($vars['EPPCode'], 0, 7) != "base64:")
			$vars['EPPCode'] = "base64:" . base64_encode($vars['EPPCode']);
			
		return $this->api->submit("namecheap.domains.transfer.create", $vars);
	}
	
	/**
	 * Requests the EPP Code for the given domain. The code is not returned,
	 * but is instead emailed to the registered domain contact (under whois).
	 * 
	 * @param array $vars An array of input params including:
	 *	- DomainName Domain name to get EPP code for
	 *	- Reason (optional) Should be one of: price, support, technical, others
	 *	- Description (optional) More information regarding the reason if available. Max length: 200
	 *	- Contact (optional) If customer can be contacted regarding this. Value should be: true/ false
	 * @return NamecheapResponses
	 */
	public function getEpp(array $vars) {
		return $this->api->submit("namecheap.domains.transfer.getEpp", $vars);
	}
	
	/**
	 * Gets the status of a particular transfer.
	 *
	 * @param array $vars An array of input params including:
	 * 	- TransferID The unique Transfer ID which you get after placing a transfer request
	 * @return NamecheapResponse
	 */
	public function getStatus(array $vars) {
		return $this->api->submit("namecheap.domains.transfer.create", $vars);
	}
	
	/**
	 * Updates the status of a particular transfer. Allows you to re-submit the
	 * transfer after releasing the registry lock.
	 *
	 * @param array $vars An array of input params including:
	 * 	- TransferID The unique TransferID
	 * 	- Resubmit The value 'true' resubmits the transfer
	 * @return NamecheapResponse
	 */
	public function updateStatus(array $vars) {
		return $this->api->submit("namecheap.domains.transfer.updateStatus", $vars);
	}
	
	/**
	 * Gets the list of domain transfers.
	 *
	 * @param array $vars An array of input params including:
	 * 	- ListType Possible values are ALL,INPROGRESS,CANCELLED,COMPLETED 
	 * 	- SearchTerm The keyword should be a domainname 
	 * 	- Page Page to return 
	 * 	- PageSize Number of transfers to be listed in a page. Minimum value is 10 and maximum value is 100.
	 * 	- SortBy Possible values are DOMAINNAME,DOMAINNAME_DESC,TRANSFERDATE,TRANSFERDATE_DESC,STATUSDATE,STATUSDATE_DESC.
	 * @return NamecheapResponse
	 */
	public function getList(array $vars) {
		return $this->api->submit("namecheap.domains.transfer.getList", $vars);
	}
}
?>