Serverdox-PHP
===========

This is the Serverdox PHP SDK. This SDK contains methods for easily interacting 
with the Serverdox API. 
Below are examples to get you started. For additional examples, please see our 
official documentation 
at https://www.serverdox.com/api/docs

[![Latest Stable Version](https://poser.pugx.org/serverdox/serverdox-php/v/stable.png)](https://packagist.org/packages/serverdox/serverdox-php)

Installation
------------
To install the SDK, you will need to be using [Composer](http://getcomposer.org/) in your project. 
If you aren't using Composer yet, it's really simple! Here's how to install 
composer and the Serverdox SDK.

```PHP
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Add Serverdox as a dependency
php composer.phar require serverdox/serverdox-php:~1.0
``` 

**For shared hosts without SSH access, check out our [Shared Host Instructions](SharedHostInstall.md).**

**Rather just download the files? [Library Download](http://www.mediafire.com/download/9y163rikuspztxo/serverdox-php-v1.0.zip).**

Next, require Composer's autoloader, in your application, to automatically 
load the Serverdox SDK in your project:
```PHP
require 'vendor/autoload.php';
use Serverdox\Serverdox;
```

Usage
-----
Here's how to create a monitor using the SDK:

```php
# First, instantiate the SDK with your API credentials.
$serverdox = new Serverdox("api-key-here");

# Now, create your monitor.
$serverdox->monitors->create(array(
    "name"                      => "Google",
    "url"                       => "https://www.google.com",
    "monitor_server_location"   => "NYC",
    "notes"                     => "My notes about Google.",
    "contacts"                  => array(
        "contact-id-here" => array(
            "sms" => true
        )
    ),
    "me_contact"                => true
));
```

Or list the 2 most recent monitors created: 
```php
# First, instantiate the SDK with your API credentials and define your domain. 
$serverdox = new Serverdox("api-key-here");

# Now, get the monitors.
$serverdox->monitors->all(array(
    'limit' => 2
));
```

Response
--------

JSON will be returned in all responses from the API, including errors.

Example: 

```php
$serverdox = new Serverdox("api-key-here");

$monitors = $serverdox->monitors->all(array(
    'limit' => 2
));

echo '<pre>', print_r($monitors), '</pre>';

```

Example Contents:  
**$monitors** will contain JSON of the API response. In the above 
example, something like the following would be displayed: 

```json
{
    "monitors": [
        {
            "id": "M_XXXXXXXXXXXXXXXX",
            "name": "Google",
            "url": "https://www.google.com",
            "monitor_server_location": "NYC",
            "current_status": "Pending",
            "notes": "My notes about Google.",
            "run": true,
            "contacts": [
                {
                    "me": false,
                    "C_XXXXXXXXXXXXXXXX": {
                        "email": false,
                        "sms": true,
                        "twitter": false
                    }
                        
                }
            ],
            "created_at": 1420070401
        },
        {
            "id": "M_XXXXXXXXXXXXXXXX",
            "name": "Serverdox",
            "url": "https://www.serverdox.com",
            "monitor_server_location": "LON",
            "current_status": 200,
            "run": true,
            "contacts": [
                {
                    "me": true,
                },
                {
                    "me": false,
                    "C_XXXXXXXXXXXXXXXX": {
                        "email": true,
                        "sms": true,
                        "twitter": false
                    }
                }
            ],
            "created_at": 1420070400
        }
    ],
    "remaining": 3,
    "livemode": true
}
```

Testing
---------

We aim to make testing our PHP SDK as simple as possible and the only change you need to make is to your API key.

To use the SDK in test mode simply put **"test_"** before your API key, e.g. **"test_XXXXXXXXXXXXXXXX"**.

In test mode most aspects of the API remain the same including account limits, API limits and errors. However, it is not possible to attach a test contact to a live monitor and vice versa. Trying to retrieve the logs of a monitor in test mode will return an error as this is also not possible in test mode.

Retrieving a test object via the API will have a JSON attribute: **"livemode": false**.


Support and Feedback
--------------------

Be sure to visit the Serverdox official 
[API documentation](http://www.serverdox.com/api-docs) for additional 
information about our API. 

If you find a bug, please submit the issue in Github directly. 
[Serverdox-PHP Issues](https://github.com/serverdox/serverdox-php/issues)

As always, if you need additional assistance, contact us at
[https://serverdox.com/contact](https://www.serverdox.com/contact).