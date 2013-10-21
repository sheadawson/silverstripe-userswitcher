#SilverStripe User Switcher

The module adds a small form both in the frontend and CMS to quickly login as any user in the system. The intended use is in testing environments, to assist in the testing of SilverStripe applications that would otherwise require multiple browsers open with users of various roles and permissions logged in. 

User Switching is only available to ADMIN users and only when running in dev or test mode.

##Screenshot

![Screenshot](https://raw.github.com/sheadawson/silverstripe-userswitcher/master/images/screenshot.png)

##Requirements

* SilverStripe 3.*

##Install

	$ composer require sheadawson/silverstripe-userswitcher dev-master

Once the module files are in your project, login as and ADMIN user and run ?flush=all 
