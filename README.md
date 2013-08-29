SilverStripe User Switcher
=============================

The module adds a small form to frontend templates to quickly login as any user in the system. The intended use is in testing environments, to assist in the testing of SilverStripe applications that would otherwise require multiple browsers open with users of various roles and permissions logged in. 

User Switching is only available to Admin users and only when running in dev or test mode.

Requirements
------------
* SilverStripe 3.*

Installation
-------------------------
1. [Install the module](http://doc.silverstripe.org/framework/en/topics/modules)
2. Add $UserSwitcherForm to your Page.ss template, just before </body>  