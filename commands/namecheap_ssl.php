<?php
/**
 * Namecheap SSL Management
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap.commands
 */
class NamecheapSsl {
	
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
	 * Activates a newly purchased SSL certificate.
	 *
	 * @param array $vars An array of input params including:
	 * 	- CertificateID Unique ID of the SSL certificate you wish to activate 
	 * 	- ApproverEmail The EmailID which is on the Approver Email list 
	 * 	- csr Certificate Signing Request 
	 * 	- WebServerType Possible values: apacheopenssl, apachessl, apacheraven, apachessleay, c2net, ibmhttp, iplanet, domino, dominogo4625, dominogo4626, netscape, zeusv3, apache2, apacheapachessl, cobaltseries, cpanel, ensim, hsphere,ipswitch, plesk, tomcat, weblogic, website, webstar, iis, other, iis4, iis5 
	 * 	- AdminOrganizationName Organization of the Admin contact
	 * 	- AdminJobTitle Job title of the Admin contact 
	 * 	- AdminFirstName First name of the Admin contact 
	 * 	- AdminLastName Last name of the Admin contact
	 * 	- AdminAddress1 Address1 of the Admin contact
	 * 	- AdminAddress2 Address2 of the Admin contact 
	 * 	- AdminCity City of the Admin contact 
	 * 	- AdminStateProvince State/Province of the Admin contact 
	 * 	- AdminStateProvinceChoice StateProvinceChoice of the Admin contact 
	 * 	- AdminPostalCode Postal/ZIP Code of the Admin contact 
	 * 	- AdminCountry Country of the Admin contact 
	 * 	- AdminPhone Phone number in the format +NNN.NNNNNNNNNN
	 * 	- AdminPhoneExt PhoneExt of the Admin contact 
	 * 	- AdminFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- AdminEmailAddress Email address of the Admin contact
	 * 	- TechOrganizationName Oraganization of the Tech contact
	 * 	- TechJobTitle Job title of the Tech contact 
	 * 	- TechFirstName First name of the Tech contact 
	 * 	- TechLastName Last name of the Tech contact 
	 * 	- TechAddress1 Address1 of the Tech contact 
	 * 	- TechAddress2 Address2 of the Tech contact 
	 * 	- TechCity City of the Tech contact 
	 * 	- TechStateProvince State/Province of the Tech contact 
	 * 	- TechStateProvinceChoice StateProvinceChoice of the Tech contact 
	 * 	- TechPostalCode Postal/ZIP Code of the Tech contact 
	 * 	- TechCountry Country of the Tech contact
	 * 	- TechPhone Phone number in format the +NNN.NNNNNNNNNN 
	 * 	- TechPhoneExt PhoneExt of the Tech contact 
	 * 	- TechFax Fax number in format the +NNN.NNNNNNNNNN 
	 * 	- TechEmailAddress Email address of the Tech contact
	 * 	- BillingOrganizationName Organization of the Billing contact 
	 * 	- BillingJobTitle Job title of the Billing contact 
	 * 	- BillingFirstName First name of the Billing contact 
	 * 	- BillingLastName Last name of the Billing contact 
	 * 	- BillingAddress1 Address1 of the Billing contact
	 * 	- BillingAddress2 Address2 of the Billing contact 
	 * 	- BillingCity City of the Billing contact 
	 * 	- BillingStateProvince State/Province of the Billing contact 
	 * 	- BillingStateProvinceChoice StateProvinceChoice of the Billing contact 
	 * 	- BillingPostalCode Postal/ZIP Code of the Billing contact 
	 * 	- BillingCountry Country of the Billing contact
	 * 	- BillingPhone Phone number in the format +NNN.NNNNNNNNNN 
	 * 	- BillingPhoneExt PhoneExt of the Billing contact
	 * 	- BillingFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- BillingEmailAddress Email address of the Billing contact
	 * 	- *** Additional Parameters ***
	 * 		Geotrust, Verisign and Thawte OV and EV Certificates and Thawte SSL 123
	 * 			- OrganizationLegalName Legal Name of the Organization
	 * 			- OrganizationDUNS DUNS of the Organization
	 * 			- OrganizationAddress1 Address1 of the Organization
	 * 			- OrganizationAddress2 Address2 of the Organization
	 * 			- OrganizationCity City of the Organization
	 * 			- OrganizationStateProvince State/Province of the Organization
	 * 			- OrganizationPostalCode PostalCode/ZIP of the Organization
	 * 			- OrganizationCountry Country of the Organization
	 * 			- OrganizationPhone Phone number in the format +NNN.NNNNNNNNNN
	 * 			- OrganizationFax Fax number in the format +NNN.NNNNNNNNNN
	 * 		Comodo EV Certificates (Comodo EV SSL, Comodo EV SGC SSL)
	 * 			- CompanyIncorporationCountry Country of Company incorpration 
	 * 			- CompanyIncorporationStateProvince State/province of company incorporation 
	 * 			- CompanyIncorporationLocality locality of company incorporation 
	 * 			- CompanyIncorporationDate Company Incorporation date 
	 * 			- CompanyDBA Company DBA
	 * 			- CompanyRegistrationNumber Registration number of the company
	 * 		Comodo OV Certificates (InstantSSL, InstantSSL Pro, PremiumSSL, PremiumSSL Wildcard)
	 * 			- OrganizationRepEmailAddress Represantative's email address used for verification by comodo
	 * 			- OrganizationRepCallbackMethod Possible values: phone, letter
	 * 			- OrganizationRepFirstName Represantative's first name
	 * 			- OrganizationRepLastName Represantative's last name
	 * 			- OrganizationRepTitle Represantative's title
	 * 			- OrganizationRepCallbackDestinationSame Possible values: yes, no
	 * 			- OrganizationRepLegalName Representative's Legal Name. This parameter is required only if OrganizationRepCallbackDestinationSame parameter is set as No
	 * 			- OrganizationRepDUNS
	 * 			- OrganizationRepAddress1 Representative's Address. This parameter is required only if OrganizationRepCallbackDestinationSame parameter is set as No
	 * 			- OrganizationRepAddress2 Representative's Address 
	 * 			- OrganizationRepCity Representative's City. This parameter is required only if OrganizationRepCallbackDestinationSame parameter is set as No
	 * 			- OrganizationRepStateProvince Representative's State/Province. This parameter is required if OrganizationRepCallbackDestinationSame parameter is set as No
	 * 			- OrganizationRepPostalCode Representative's postal code. This parameter is required only if OrganizationRepCallbackDestinationSame parameter is set as No
	 * 			- OrganizationRepCountry Representative's country. This parameter is required only if OrganizationRepCallbackDestinationSame parameter is set as No
	 * 			- OrganizationRepPhone Representative's phone number
	 * 			- OrganizationRepFax Representative's fax number
	 * 			- OrganizationRepPostOfficeBox Representative's PO Box
	 * @return NamecheapResponse
	 */
	public function activate(array $vars) {
		return $this->api->submit("namecheap.ssl.activate", $vars);
	}
	
	/**
	 * Retrieves information about the requested SSL certificate
	 *
	 * @param array $vars An array of input params including:
	 * 	- CertificateID Unique ID of the SSL Certificate
	 * @return NamecheapResponse
	 */
	public function getInfo(array $vars) {
		return $this->api->submit("namecheap.ssl.getInfo", $vars);
	}
	
	/**
	 * Parsers the CSR
	 *
	 * @param array $vars An array of input params including:
	 * 	- csr Certificate Signing Request
	 * 	- CertificateType Type of SSL Certificate
	 * @return NamecheapResponse
	 */
	public function parseCsr(array $vars) {
		return $this->api->submit("namecheap.ssl.parseCSR", $vars);
	}
	
	/**
	 * Gets approver email list for the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName Domain name to get the list
	 * 	- CertificateType Type of SSL Certificate
	 * @return NamecheapResponse
	 */
	public function getApproverEmailList(array $vars) {
		return $this->api->submit("namecheap.ssl.getApproverEmailList", $vars);
	}
	
	/**
	 * Returns a list of SSL certificates for a particular user.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName Domain name to get the list
	 * 	- CertificateType Type of SSL Certificate
	 * @return NamecheapResponse
	 */
	public function getList(array $vars) {
		return $this->api->submit("namecheap.ssl.getList", $vars);
	}
	
	/**
	 * Creates a new SSL certificate.
	 *
	 * @param array $vars An array of input params including:
	 * 	- Years Number of years to register 
	 * 	- PromotionCode Promotional (coupon) code for the certificate 
	 * 	- Type Type of SSL (QuickSSL, QuickSSL Premium, RapidSSL, RapidSSL Wildcard, PremiumSSL, InstantSSL, PositiveSSL, PositiveSSL Wildcard, True BusinessID with EV, True BusinessID , True BusinessID Wildcard , Secure Site , Secure Site Pro , Secure Site with EV , Secure Site Pro with EV, EssentialSSL, EssentialSSL Wildcard, InstantSSL Pro, Premiumssl wildcard, EV SSL, EV SSL SGC, SSL123, SSL Web Server, SGC Super Certs, SSL Webserver EV)
	 * @return NamecheapResponse
	 */
	public function create(array $vars) {
		return $this->api->submit("namecheap.ssl.create", $vars);
	}
	
	/**
	 * Resends the approver email.
	 *
	 * @param array $vars An array of input params including:
	 * 	- CertificateID The unique certID that you get after calling ssl.create command 
	 * @return NamecheapResponse
	 */
	public function resendApproverEmail(array $vars) {
		return $this->api->submit("namecheap.ssl.resendApproverEmail", $vars);
	}

	/**
	 * Resends the fulfilment email containing the certificate.
	 *
	 * @param array $vars An array of input params including:
	 * 	- CertificateID The unique certID that you get after calling ssl.create command
	 * @return NamecheapResponse
	 */
	public function resendFulfillmentEmail(array $vars) {
		return $this->api->submit("namecheap.ssl.resendFulfillmentEmail", $vars);
	}
}
?>