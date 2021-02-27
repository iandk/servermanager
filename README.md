# Servermanager

## 1. Requirements
- Apache 2.4 with mod_rewrite enabled
- PHP 7.4+ with php exec enabled if you want to use the Ping function


The ping method requires the exec function to be enabled. 
Please keep in mind that the hostname of the host will be used to ping, not the IP(s).


## 2. Installation
Upload the application to your server or shared hosting and set the document root to the "public" folder.
   
Make sure that mod_rewrite is enabled and the .htaccess file is present.

Since there is no authentification for the frontend and the API you should configure a htpasswd protection or restrict the IP access. 


## 3. Config
You can change set the following parameters in the ```app/js/app.js```
```
title: 'My hosts',
currency: '€',
billingTerm: 'month',
// Set this to true if you don't want to see the pricing input and table view
// This is useful when used internally and you don't need to specifiy the price for hosts
disablePricing: false,
//This settings disables the ping check in the background, set this to true 
// if your environment doesn't support php exec or you don't need this this function
disablePing: false,
```


## 4. Demo
![](https://i.imgur.com/mRdAkg5.png)
