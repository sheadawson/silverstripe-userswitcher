<?php

namespace SheaDawson\UserSwitcher;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Control\Controller;

/**
 * Clears the UserSwitched session variable on member logout
 *
 * @author Shea Dawson <shea@livesource.co.nz>
 * @license BSD http://silverstripe.org/bsd-license/
 */
class UserSwitcherMemberExtension extends DataExtension
{

    public function memberLoggedOut()
    {
        Controller::curr()->getRequest()->getSession()->clear('UserSwitched');
    }
}
