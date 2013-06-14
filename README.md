# Namecheap API #

Namecheap is a domain registrar. This API is a wrapper for the [Namecheap web API](http://developer.namecheap.com/docs/doku.php?id=api-reference:index), each command is mapped one-to-one with a Class and Method. For example, [registering a domain](http://developer.namecheap.com/docs/doku.php?id=api-reference:domains:create) requires the namecheap.domains.create API command, which is executed via NamecheapDomains::create().

## Requirements ##

* PHP 5.1.3 or greater

### Using the API ###

```php
<?php
require_once "namecheap_api.php";

$user = "YOUR_NAMECHEAP_USER"; // Username required to access the API 
$key = "YOUR_NAMECHEAP_KEY"; // Password required used to access the API 
$sandbox = true; // true for testing, false for live
$username = null; // The Username on which a command is executed.Generally, the values of ApiUser and UserName parameters are the same. 

$api = new NamecheapApi($user, $key, $sandbox, $username);

// Create a new instance of the command class we want to use
$domains = new NamecheapDomains($api);

$vars = array('DomainList' => "mydomain.com");

print_r($domains->check($vars)->response());
?>
```