<?php
/**
 * Namecheap Domain Management
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap.commands
 */
class NamecheapDomains {
	
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
	 * Returns a list of domains for the particular user.
	 *
	 * @param array $vars An array of input params including:
	 * 	- ListType Possible values are ALL/EXPIRING/EXPIRED
	 * 	- SearchTerm Keyword to look for on the domain list 
	 * 	- Page Page to return 
	 * 	- PageSize Number of domains to be listed in a page. Minimum value is 10 and maximum value is 100. 
	 * 	- SortBy Possible values are NAME, NAME_DESC, EXPIREDATE, EXPIREDATE_DESC, CREATEDATE, CREATEDATE_DESC.
	 * @return NamecheapResponse
	 */
	public function getList(array $vars) {
		return $this->api->submit("namecheap.domains.getList", $vars);
	}

	/**
	 * Returns a list of tlds
	 * 
	 * @return NamecheapResponse
	 */	
	public function getTldList() {
		return $this->api->submit("namecheap.domains.getTldList");
	}
	
	/**
	 * Registers a new domain name.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName The domain name to register (MUST BE in Puncycode if international)
	 * 	- Years Number of years to register
	 * 	- PromotionCode Promotional (coupon) code for the domain 
	 * 	- RegistrantOrganizationName Organization of the Registrant user 
	 * 	- RegistrantJobTitle Job title of the Registrant user
	 * 	- RegistrantFirstName First name of the Registrant user 
	 * 	- RegistrantLastName Last name of the Registrant user 
	 * 	- RegistrantAddress1 Address1 of the Registrant user 
	 * 	- RegistrantAddress2 Address2 of the Registrant user 
	 * 	- RegistrantCity City of the Registrant user 
	 * 	- RegistrantStateProvince State/Province of the Registrant user 
	 * 	- RegistrantStateProvinceChoice StateProvinceChoice of the Registrant user 
	 * 	- RegistrantPostalCode PostalCode of the Registrant user 
	 * 	- RegistrantCountry Country of the Registrant user
	 * 	- RegistrantPhone Phone number in the format +NNN.NNNNNNNNNN 
	 * 	- RegistrantPhoneExt PhoneExt of the Registrant user 
	 * 	- RegistrantFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- RegistrantEmailAddress Email address of the Registrant user 
	 * 	- TechOrganizationName Oraganization of the Tech user
	 * 	- TechJobTitle Job title of the Tech user 
	 * 	- TechFirstName First name of the Tech user 
	 * 	- TechLastName Last name of the Tech user 
	 * 	- TechAddress1 Address1 of the Tech user 
	 * 	- TechAddress2 Address2 of the Tech user 
	 * 	- TechCity City of the Tech user 
	 * 	- TechStateProvince State/Province of the Tech user 
	 * 	- TechStateProvinceChoice StateProvinceChoice of the Tech user 
	 * 	- TechPostalCode Postal/ZIP Code of the Tech user 
	 * 	- TechCountry Country of the Tech user
	 * 	- TechPhone Phone number in format the +NNN.NNNNNNNNNN 
	 * 	- TechPhoneExt PhoneExt of the Tech user 
	 * 	- TechFax Fax number in format the +NNN.NNNNNNNNNN 
	 * 	- TechEmailAddress Email address of the Tech user
	 * 	- AdminOrganizationName Organization of the Admin user
	 * 	- AdminJobTitle Job title of the Admin user 
	 * 	- AdminFirstName First name of the Admin user 
	 * 	- AdminLastName Last name of the Admin user
	 * 	- AdminAddress1 Address1 of the Admin user
	 * 	- AdminAddress2 Address2 of the Admin user 
	 * 	- AdminCity City of the Admin user 
	 * 	- AdminStateProvince State/Province of the Admin user 
	 * 	- AdminStateProvinceChoice StateProvinceChoice of the Admin user 
	 * 	- AdminPostalCode Postal/ZIP Code of the Admin user 
	 * 	- AdminCountry Country of the Admin user 
	 * 	- AdminPhone Phone number in the format +NNN.NNNNNNNNNN
	 * 	- AdminPhoneExt PhoneExt of the Admin user 
	 * 	- AdminFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- AdminEmailAddress Email address of the Admin user 
	 * 	- AuxBillingOrganizationName Organization of the AuxBilling user 
	 * 	- AuxBillingJobTitle Job title of the AuxBilling user 
	 * 	- AuxBillingFirstName First name of the AuxBilling user 
	 * 	- AuxBillingLastName Last name of the AuxBilling user 
	 * 	- AuxBillingAddress1 Address1 of the AuxBilling user
	 * 	- AuxBillingAddress2 Address2 of the AuxBilling user 
	 * 	- AuxBillingCity City of the AuxBilling user 
	 * 	- AuxBillingStateProvince State/Province of the AuxBilling user 
	 * 	- AuxBillingStateProvinceChoice StateProvinceChoice of the AuxBilling user 
	 * 	- AuxBillingPostalCode Postal/ZIP Code of the AuxBilling user 
	 * 	- AuxBillingCountry Country of the AuxBilling user
	 * 	- AuxBillingPhone Phone number in the format +NNN.NNNNNNNNNN 
	 * 	- AuxBillingPhoneExt PhoneExt of the AuxBilling user
	 * 	- AuxBillingFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- AuxBillingEmailAddress Email address of the AuxBilling user 
	 * 	- BillingFirstName First name for the invoice 
	 * 	- BillingLastName Last name for the invoice 
	 * 	- BillingAddress1 Address1 for the invoice 
	 * 	- BillingAddress2 Address2 for the invoice 
	 * 	- BillingCity City for the invoice 
	 * 	- BillingStateProvince State/Province for the invoice 
	 * 	- BillingStateProvinceChoice StateProvinceChoice for the invoice 
	 * 	- BillingPostalCode Postal/ZIP Code for the invoice
	 * 	- BillingCountry Country for the invoice
	 * 	- BillingPhone Phone number for the invoice. Format: +NNN.NNNNNNNNNN
	 * 	- BillingPhoneExt PhoneExt for the invoice 
	 * 	- BillingFax Fax number for the invoice. Format: +NNN.NNNNNNNNNN
	 * 	- BillingEmailAddress Email address for the invoice 
	 * 	- IdnCode Code of Internationalized Domain Name (please refer to the note)
	 * 	- Nameservers A comma-separated list of custom nameservers to be associated with the domain name 
	 * 	- AddFreeWhoisguard Adds free WhoisGuard for the domain purchased 
	 * 	- WGEnabled Enables free WhoisGuard for this domain 
	 * 	- AddFreePositiveSSL Adds free PositiveSSL for the domain purchased
	 * 	- *** Extended attributes ***
	 * 		.US domain
	 * 			- RegistrantNexus C11, C12 , C21, C31, C32
	 * 			- RegistrantNexusCountry Two-digit country code
	 * 			- RegistrantPurpose P1,P2,P3,P4,P5
	 * 		.EU domain
	 * 			- EUAgreeWhoisPolicy YES
	 * 			- EUAgreeDeletePolicy YES, NO
	 * 			- EUAdrLang BG,CS,DS,NL,EN,ET,FI,FR,DE,,HU, IT,LV,LI,MT,PL,RO,SK,SL,ES,SV
	 * 		.CA domain
	 * 			- CIRALegalType CCO, CCT, RES, GOV, EDU, ASS, HOP, PRT, TDM, TRD, PLT, LAM, TRS, ABO, INB, LGR, OMK, MAJ 
	 * 			- CIRAWhoisDisplay Full, Private Does the registrant want their contact information to be published in CIRA’s public Whois? Individuals (CCT, RES, ABO, LGR) may keep their Registrant contact information private in CIRA’s Whois; non-individuals must show their full Registrant information. 
	 * 			- CIRAAgreementVersion 2.0 Version of the CIRA Registrant Agreement to which Registrant is agreeing. 
	 * 			- CIRAAgreementValue Y This value should be Y (agreed to agreement) for the domain to be registered. Passing other values will fail the registration
	 * 			- CIRALanguage en, fr Language in which to communicate with he contact. Default is en
	 * 		.CO.UK domain
	 * 			- COUKLegalType IND, FIND, LTD , PLC, PTNR, LLP, IP, STRA,SCH,FOTHER, RCHAR, GOV, OTHER, CRC, FCORP, STAT, FOTHER
	 * 			- COUKCompanyID Company Identification Number
	 * 			- COUKRegisteredfor Company or Person the domain is registered for
	 * 		.ME.UK domain
	 * 			- MEUKLegalType IND, FIND, LTD , PLC, PTNR, LLP, IP, STRA,SCH,FOTHER, RCHAR, GOV, OTHER, CRC, FCORP, STAT, FOTHER
	 * 			- MEUKCompanyID Company Identification Number
	 * 			- MEUKRegisteredfor Company or Person the domain is registered for
	 * 		.ORG.UK domain
	 * 			- ORGUKLegalType IND, FIND, LTD , PLC, PTNR, LLP, IP, STRA,SCH,FOTHER, RCHAR, GOV, OTHER, CRC, FCORP, STAT, FOTHER
	 * 			- ORGUKCompanyID Company Identification Number
	 * 			- ORGUKRegisteredfor Company or Person the domain is registered for
	 * 		.ASIA domain
	 * 			- ASIACCLocality af, bd, ck, in, jp, kg, mh, nz, ps, sg, th, tv, aq, bt, cy, id, kz, la, fm, nu, pg, sb, tl, ae, am, bn, fj, ir, ki, lb, mn, nf, ph, lk, tk, uz, au, kh, ge, iq, kp, mo, mm, om, qa, sy, to, vu, az, cn, hm, il, kr, my, nr, pk, ws, tw, tr, vn, bh, cc, hk, jo, kw, mv, np, pw, sa, tj, tm, ye
	 * 			- ASIALocalityCity City of Establishment of the Entity
	 * 			- ASIALocalitySP State/Province of Establishment of the Entity
	 * 			- ASIALegalEntityType corporation, cooperative, partnership, government, politicalParty, society, institution, naturalPerson, other
	 * 			- ASIAIdentForm certificate,legislation, societyRegistry, politicalPartyRegistry, passport, other
	 * 			- ASIAIdentNumber Form of Identity ID Number/Code of Reference
	 * 			- ASIAOtherleType Other Entity Type. Other Entry Type requires if you chose possible value Other in ASIALegalEntityType Extended attribute
	 * 			- ASIAOtherIdentForm Other Identification Form. Other Identification Form required if you chose possible value Other in ASIAIdentForm Extended attribute
	 * 		.DE domain
	 * 			- DEConfirmAddress DE To confirm the Administrative address is a valid German address
	 * 			- DEAgreeDelete YES, NO To agree the renewal terms for the domain name
	 */
	public function create(array $vars) {
		return $this->api->submit("namecheap.domains.create", $vars);
	}
	
	/**
	 * Gets contact information for the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName Domain to get contacts
	 * @return NamecheapResponse
	 */
	public function getContacts(array $vars) {
		return $this->api->submit("namecheap.domains.getContacts", $vars);
	}
	
	/**
	 * Sets contact information for the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName Domain to set contacts 
	 * 	- RegistrantOrganizationName Organization of the Registrant user 
	 * 	- RegistrantJobTitle Job title of the Registrant user
	 * 	- RegistrantFirstName First name of the Registrant user 
	 * 	- RegistrantLastName Last name of the Registrant user 
	 * 	- RegistrantAddress1 Address1 of the Registrant user 
	 * 	- RegistrantAddress2 Address2 of the Registrant user 
	 * 	- RegistrantCity City of the Registrant user 
	 * 	- RegistrantStateProvince State/Province of the Registrant user 
	 * 	- RegistrantStateProvinceChoice StateProvinceChoice of the Registrant user 
	 * 	- RegistrantPostalCode PostalCode of the Registrant user 
	 * 	- RegistrantCountry Country of the Registrant user
	 * 	- RegistrantPhone Phone number in the format +NNN.NNNNNNNNNN 
	 * 	- RegistrantPhoneExt PhoneExt of the Registrant user 
	 * 	- RegistrantFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- RegistrantEmailAddress Email address of the Registrant user 
	 * 	- TechOrganizationName Oraganization of the Tech user
	 * 	- TechJobTitle Job title of the Tech user 
	 * 	- TechFirstName First name of the Tech user 
	 * 	- TechLastName Last name of the Tech user 
	 * 	- TechAddress1 Address1 of the Tech user 
	 * 	- TechAddress2 Address2 of the Tech user 
	 * 	- TechCity City of the Tech user 
	 * 	- TechStateProvince State/Province of the Tech user 
	 * 	- TechStateProvinceChoice StateProvinceChoice of the Tech user 
	 * 	- TechPostalCode Postal/ZIP Code of the Tech user 
	 * 	- TechCountry Country of the Tech user
	 * 	- TechPhone Phone number in format the +NNN.NNNNNNNNNN 
	 * 	- TechPhoneExt PhoneExt of the Tech user 
	 * 	- TechFax Fax number in format the +NNN.NNNNNNNNNN 
	 * 	- TechEmailAddress Email address of the Tech user
	 * 	- AdminOrganizationName Organization of the Admin user
	 * 	- AdminJobTitle Job title of the Admin user 
	 * 	- AdminFirstName First name of the Admin user 
	 * 	- AdminLastName Last name of the Admin user
	 * 	- AdminAddress1 Address1 of the Admin user
	 * 	- AdminAddress2 Address2 of the Admin user 
	 * 	- AdminCity City of the Admin user 
	 * 	- AdminStateProvince State/Province of the Admin user 
	 * 	- AdminStateProvinceChoice StateProvinceChoice of the Admin user 
	 * 	- AdminPostalCode Postal/ZIP Code of the Admin user 
	 * 	- AdminCountry Country of the Admin user 
	 * 	- AdminPhone Phone number in the format +NNN.NNNNNNNNNN
	 * 	- AdminPhoneExt PhoneExt of the Admin user 
	 * 	- AdminFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- AdminEmailAddress Email address of the Admin user 
	 * 	- AuxBillingOrganizationName Organization of the AuxBilling user 
	 * 	- AuxBillingJobTitle Job title of the AuxBilling user 
	 * 	- AuxBillingFirstName First name of the AuxBilling user 
	 * 	- AuxBillingLastName Last name of the AuxBilling user 
	 * 	- AuxBillingAddress1 Address1 of the AuxBilling user
	 * 	- AuxBillingAddress2 Address2 of the AuxBilling user 
	 * 	- AuxBillingCity City of the AuxBilling user 
	 * 	- AuxBillingStateProvince State/Province of the AuxBilling user 
	 * 	- AuxBillingStateProvinceChoice StateProvinceChoice of the AuxBilling user 
	 * 	- AuxBillingPostalCode Postal/ZIP Code of the AuxBilling user 
	 * 	- AuxBillingCountry Country of the AuxBilling user
	 * 	- AuxBillingPhone Phone number in the format +NNN.NNNNNNNNNN 
	 * 	- AuxBillingPhoneExt PhoneExt of the AuxBilling user
	 * 	- AuxBillingFax Fax number in the format +NNN.NNNNNNNNNN 
	 * 	- AuxBillingEmailAddress Email address of the AuxBilling user
	 * 	- *** Extended attributes ***
	 * 		.US domain
	 * 			- RegistrantNexus C11, C12 , C21, C31, C32
	 * 			- RegistrantNexusCountry Two-digit country code
	 * 			- RegistrantPurpose P1,P2,P3,P4,P5
	 * 		.EU domain
	 * 			- EUAgreeWhoisPolicy YES
	 * 			- EUAgreeDeletePolicy YES, NO
	 * 			- EUAdrLang BG,CS,DS,NL,EN,ET,FI,FR,DE,,HU, IT,LV,LI,MT,PL,RO,SK,SL,ES,SV
	 * 		.CA domain
	 * 			- CIRALegalType CCO, CCT, RES, GOV, EDU, ASS, HOP, PRT, TDM, TRD, PLT, LAM, TRS, ABO, INB, LGR, OMK, MAJ 
	 * 			- CIRAWhoisDisplay Full, Private Does the registrant want their contact information to be published in CIRA’s public Whois? Individuals (CCT, RES, ABO, LGR) may keep their Registrant contact information private in CIRA’s Whois; non-individuals must show their full Registrant information. 
	 * 			- CIRAAgreementVersion 2.0 Version of the CIRA Registrant Agreement to which Registrant is agreeing. 
	 * 			- CIRAAgreementValue Y This value should be Y (agreed to agreement) for the domain to be registered. Passing other values will fail the registration
	 * 			- CIRALanguage en, fr Language in which to communicate with he contact. Default is en
	 * 		.CO.UK domain
	 * 			- COUKLegalType IND, FIND, LTD , PLC, PTNR, LLP, IP, STRA,SCH,FOTHER, RCHAR, GOV, OTHER, CRC, FCORP, STAT, FOTHER
	 * 			- COUKCompanyID Company Identification Number
	 * 			- COUKRegisteredfor Company or Person the domain is registered for
	 * 		.ME.UK domain
	 * 			- MEUKLegalType IND, FIND, LTD , PLC, PTNR, LLP, IP, STRA,SCH,FOTHER, RCHAR, GOV, OTHER, CRC, FCORP, STAT, FOTHER
	 * 			- MEUKCompanyID Company Identification Number
	 * 			- MEUKRegisteredfor Company or Person the domain is registered for
	 * 		.ORG.UK domain
	 * 			- ORGUKLegalType IND, FIND, LTD , PLC, PTNR, LLP, IP, STRA,SCH,FOTHER, RCHAR, GOV, OTHER, CRC, FCORP, STAT, FOTHER
	 * 			- ORGUKCompanyID Company Identification Number
	 * 			- ORGUKRegisteredfor Company or Person the domain is registered for
	 * 		.ASIA domain
	 * 			- ASIACCLocality af, bd, ck, in, jp, kg, mh, nz, ps, sg, th, tv, aq, bt, cy, id, kz, la, fm, nu, pg, sb, tl, ae, am, bn, fj, ir, ki, lb, mn, nf, ph, lk, tk, uz, au, kh, ge, iq, kp, mo, mm, om, qa, sy, to, vu, az, cn, hm, il, kr, my, nr, pk, ws, tw, tr, vn, bh, cc, hk, jo, kw, mv, np, pw, sa, tj, tm, ye
	 * 			- ASIALocalityCity City of Establishment of the Entity
	 * 			- ASIALocalitySP State/Province of Establishment of the Entity
	 * 			- ASIALegalEntityType corporation, cooperative, partnership, government, politicalParty, society, institution, naturalPerson, other
	 * 			- ASIAIdentForm certificate,legislation, societyRegistry, politicalPartyRegistry, passport, other
	 * 			- ASIAIdentNumber Form of Identity ID Number/Code of Reference
	 * 			- ASIAOtherleType Other Entity Type. Other Entry Type requires if you chose possible value Other in ASIALegalEntityType Extended attribute
	 * 			- ASIAOtherIdentForm Other Identification Form. Other Identification Form required if you chose possible value Other in ASIAIdentForm Extended attribute
	 * 		.DE domain
	 * 			- DEConfirmAddress DE To confirm the Administrative address is a valid German address
	 * 			- DEAgreeDelete YES, NO To agree the renewal terms for the domain name
	 * @return NamecheapResponse
	 */
	public function setContacts(array $vars) {
		return $this->api->submit("namecheap.domains.setContacts", $vars);	
	}
	
	/**
	 * Checks the availability of a domain name.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainList One or more comma-separated list of domain to check
	 * @return NamecheapResponse
	 */
	public function check(array $vars) {
		return $this->api->submit("namecheap.domains.check", $vars);
	}
	
	/**
	 * Reactivates an expired domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName DomainName to reactivate
	 * @return NamecheapResponse
	 */
	public function reactivate(array $vars) {
		return $this->api->submit("namecheap.domains.reactivate", $vars);
	}
	
	/**
	 * Renews an expiring domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName DomainName to renew
	 * 	- Years Number of years to renew
	 * 	- PromotionCode Promotional (coupon) code for renewing the domain 
	 * @return NamecheapResponse
	 */
	public function renew(array $vars) {
		return $this->api->submit("namecheap.domains.renew", $vars);
	}
	
	/**
	 * Gets the RegistrarLock status for the requested domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName DomainName to get status
	 * @return NamecheapResponse
	 */
	public function getRegistrarLock(array $vars) {
		return $this->api->submit("namecheap.domains.getRegistrarLock", $vars);
	}
	
	/**
	 * Sets the RegistrarLock status for a domain.
	 *
	 * @param array $vars An array of input params including:
	 * 	- DomainName DomainName to set status
	 * 	- LockAction Possible values are LOCK and UNLOCK 
	 * @return NamecheapResponse
	 */
	public function setRegistrarLock(array $vars) {
		return $this->api->submit("namecheap.domains.setRegistrarLock", $vars);
	}
}
?>