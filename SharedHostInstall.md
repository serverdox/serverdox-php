Shared Host Installation
========================

If you do not have SSH access to your server, fear not! You can still run
composer and download the SDK. Here's how...

Installation
------------

Linux / Mac OSX:  
*PHP is typically installed by default, consult your distribution documentation. Instructions from [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).*  

1. curl -sS https://getcomposer.org/installer | php  
2. php composer.phar require serverdox/serverdox-php:~1.0
3. The files will be downloaded to your local computer.   
4. Upload the files to your webserver.   


Windows:  
*PHP must be installed on your computer, [download](http://windows.php.net/download/). Instructions from [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-windows).* 

1. Download and run [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe).  
2. Open a Command Prompt and type "php composer require serverdox/serverdox-php:~1.0".  
3. The files will be downloaded to your local computer.   
4. Upload the files to your webserver.   


Support and Feedback
--------------------

Be sure to visit the Serverdox official 
[API documentation](http://www.serverdox.com/api-docs) for additional 
information about our API. 

If you find a bug, please submit the issue in Github directly. 
[Serverdox-PHP Issues](https://github.com/Serverdox/Serverdox-PHP/issues)

As always, if you need additional assistance, contact us at
[https://serverdox.com/contact](https://www.serverdox.com/contact).