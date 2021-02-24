# Servermanager

## 1. Requirements
- Apache 2.4
- Mod Rewrite 
- PHP 7.4+
- PHP exec enabled
The ping method requires the exec function to be enabled. 
Please keep in mind that the hostname of the host will be used to ping, not the IP(s).


## 2. Installation
Upload the application to your server or shared hosting and set the document root to the "public" folder.
Since there is no authentification for the frontend and the API you should configure a htpasswd protection or restrict the IP access. 


Also make sure you have mod rewrite enabled and the .htaccess is present.
