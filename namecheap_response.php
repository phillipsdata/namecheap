<?php
/**
 * Namecheap API response handler
 *
 * @copyright Copyright (c) 2013, Phillips Data, Inc.
 * @license http://opensource.org/licenses/mit-license.php MIT License
 * @package namecheap
 */
class NamecheapResponse {
	
	/**
	 * @var SimpleXMLElement The XML parsed response from the API
	 */
	private $xml;
	/**
	 * @var string The raw response from the API
	 */	
	private $raw;

	/**
	 * Initializes the Namecheap Response
	 *
	 * @param string $response The raw XML response data from an API request
	 */
	public function __construct($response) {
		$this->raw = $response;
		
		try {
			$this->xml = new SimpleXMLElement($this->raw);
		}
		catch (Exception $e) {
			// Invalid response
		}
	}
	
	/**
	 * Returns the CommandResponse
	 *
	 * @return stdClass A stdClass object representing the CommandResponses, null if invalid response
	 */
	public function response() {
		if ($this->xml && $this->xml instanceof SimpleXMLElement) {
			return $this->formatResponse($this->xml->CommandResponse);
		}
		return null;
	}
	
	/**
	 * Returns the status of the API Responses
	 *
	 * @return string The status (OK = success, ERROR = error, null = invalid responses)
	 */
	public function status() {
		if ($this->xml && $this->xml instanceof SimpleXMLElement) {
			return (string)$this->xml->attributes()->Status;
		}
		return null;
	}
	
	/**
	 * Returns all errors contained in the response
	 *
	 * @return stdClass A stdClass object representing the errors in the response, false if invalid response
	 */
	public function errors() {
		if ($this->xml && $this->xml instanceof SimpleXMLElement) {
			return $this->formatResponse($this->xml->Errors);
		}
		return false;
	}
	
	/**
	 * Returns all warnings contained in the response
	 *
	 * @return stdClass A stdClass object representing the warnings in the response, false if invalid response
	 */
	public function warnings() {
		if ($this->xml && $this->xml instanceof SimpleXMLElement) {
			return $this->formatResponse($this->xml->Warnings);
		}
		return false;
	}
	
	/**
	 * Returns the raw response
	 *
	 * @return string The raw response
	 */
	public function raw() {
		return $this->raw;
	}
	
	/**
	 * Formats the given $data into a stdClass object by first JSON encoding, then JSON decoding it
	 *
	 * @param mixed $data The data to convert to a stdClass object
	 * @return stdClass $data in a stdClass object form
	 */
	private function formatResponse($data) {
		return json_decode(json_encode($data));
	}
}
?>