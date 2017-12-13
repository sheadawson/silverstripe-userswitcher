# SilverStripe User Switcher

The module adds a small form both in the frontend to quickly login as any user in the system. The intended use is in testing environments, to assist in the testing of SilverStripe applications that would otherwise require multiple browsers open with users of various roles and permissions logged in.

User Switching is only available to ADMIN users and only when running in dev or test mode.

## Screenshot

![Screenshot](https://raw.github.com/sheadawson/silverstripe-userswitcher/master/images/screenshot.png)

## Requirements

* SilverStripe ^4.0

## Integration with Better Navigator

If you have installed the Better Navigator module (recommended), the userwitcher dropdown field will be placed in the Better Navigator tools container instead of the bottom of the page. https://github.com/jonom/silverstripe-betternavigator

NOTE: currently you will need to copy userswitcher/templates/BetterNavigator to either your theme dir or project dir for this to work.

## Disable default jQuery

If using this on the frontend, you can disable jQuery like so:

```php
Requirements::block(THIRDPARTY_DIR . '/jquery/jquery.js');
```

## Install

	$ composer require sheadawson/silverstripe-userswitcher

Once the module files are in your project, login as and ADMIN user and run ?flush=all

## TODO

Get working in SilverStripe 4 CMS. Currently only upgraded for frontend use.
