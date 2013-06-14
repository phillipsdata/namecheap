<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "namecheap_response.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . "namecheap_domains.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . "namecheap_domains_dns.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . "namecheap_domains_ns.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . "namecheap_domains_transfer.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . "namecheap_ssl.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . "namecheap_users.php";
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . "namecheap_users_address.php";

/**
 * Namecheap API processor
 *
 * Documentation on the Namecheap API: http://developer.namecheap.com/docs/
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap
 */
class NamecheapApi {

	const SANDBOX_URL = "https://api.sandbox.namecheap.com/xml.response";
	const LIVE_URL = "https://api.namecheap.com/xml.response";

	/**
	 * @var string The user to connect as
	 */
	private $user;
	/**
	 * @var string The username to execute an API command using
	 */
	private $username;
	/**
	 * @var string The key to use when connecting
	 */
	private $key;
	/**
	 * @var boolean Whether or not to process in sandbox mode (for testing)
	 */
	private $sandbox;
	/**
	 * @var array An array representing the last request made
	 */
	private $last_request = array('url' => null, 'args' => null);
	
	/**
	 * Sets the connection details
	 *
	 * @param string $user The user to connect as
	 * @param string $key The key to use when connecting
	 * @param boolean $sandbox Whether or not to process in sandbox mode (for testing)
	 * @param string $username The username to execute an API command using
	 */
	public function __construct($user, $key, $sandbox = true, $username = null) {
		$this->user = $user;
		$this->key = $key;
		$this->sandbox = $sandbox;
		
		if (!$username)
			$username = $user;
			
		$this->username = $username;
	}
	
	/**
	 * Submits a request to the API
	 *
	 * @param string $command The command to submit
	 * @param array $args An array of key/value pair arguments to submit to the given API command
	 * @return NamecheapResponse The response object
	 */
	public function submit($command, array $args = array()) {

		$url = self::LIVE_URL;
		if ($this->sandbox)
			$url = self::SANDBOX_URL;
		
		$args['ApiUser'] = $this->user;
		if (!array_key_exists("UserName", $args))
			$args['UserName'] = $this->username;
		$args['ApiKey'] = $this->key;
		$args['Command'] = $command;
		
		if (!isset($args['ClientIP']))
			$args['ClientIP'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "127.0.0.1";
		
		$this->last_request = array(
			'url' => $url,
			'args' => $args
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$response = curl_exec($ch);
		curl_close($ch);
		
		return new NamecheapResponse($response);
	}
	
	/**
	 * Returns the details of the last request made
	 *
	 * @return array An array containg:
	 * 	- url The URL of the last request
	 * 	- args The paramters passed to the URL
	 */
	public function lastRequest() {
		return $this->last_request;
	}
}
?>