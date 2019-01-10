<?php

namespace SheaDawson\UserSwitcher;

use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Control\Director;
use SilverStripe\Control\Controller;
use SilverStripe\Security\Permission;

/**
 * UserSwitcher
 *
 * @author Shea Dawson <shea@livesource.co.nz>
 * @license BSD http://silverstripe.org/bsd-license/
 */
class UserSwitcher
{
    use Injectable;

    public function canUserSwitch()
    {
        $session = Controller::curr()->getRequest()->getSession();
        return !Director::isLive() && ($session->get('UserSwitched') || Permission::check('ADMIN'));
    }
}
