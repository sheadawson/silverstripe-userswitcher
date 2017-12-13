<?php

namespace SheaDawson\UserSwitcher;

use SilverStripe\Core\Extension;
use SilverStripe\Control\Director;
use SilverStripe\View\Requirements;

/**
 * Provides a UserSwitcherForm on Controller
 *
 * @author Shea Dawson <shea@livesource.co.nz>
 * @license BSD http://silverstripe.org/bsd-license/
 */
class UserSwitcherControllerExtension extends Extension
{

    private static $allowed_actions = array(
        'UserSwitcherFormHTML'
    );

    public function onAfterInit()
    {
        // Ignore in dev/build
        if ($this->owner instanceof DevelopmentAdmin ||
            $this->owner instanceof DevBuildController ||
            $this->owner instanceof DatabaseAdmin) {
            return;
        }
        // NOTE: Director::is_ajax() is to avoid these files
        //       being re-included.
        //
        //       Fixes case where you Requirements::block() jquery.js
        //       in your Page::init(), but it's not respected due
        //       to this providing jquery.js again with jquery.ondemand.
        //
        if (Director::is_ajax()) {
            return;
        }

        if (singleton('SheaDawson\UserSwitcher\UserSwitcher')->canUserSwitch()) {
            $url = $this->owner->getRequest()->getURL();
            if (substr($url, 0, 6) == 'admin/') {
                //Requirements::javascript('userswitcher/javascript/userswitcher.js');
                //Requirements::css('userswitcher/css/userswitcher-admin.css');
            } else {
                //Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
                Requirements::javascript('userswitcher/javascript/userswitcher.js');
                Requirements::css('userswitcher/css/userswitcher-front.css');
            }
        }
    }

    public function UserSwitcherFormHTML()
    {
        if (!singleton('SheaDawson\UserSwitcher\UserSwitcher')->canUserSwitch()) {
            return;
        }
        return singleton('SheaDawson\UserSwitcher\UserSwitcherController')->UserSwitcherForm()->forTemplate();
    }
}
