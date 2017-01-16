<?php
/**
 * Provides a UserSwitcherForm on Controller 
 *
 * @author Shea Dawson <shea@livesource.co.nz>
 * @license BSD http://silverstripe.org/bsd-license/
 */
class UserSwitcherControllerExtension extends Extension
{

    public static $allowed_actions = array(
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
        
        if (singleton('UserSwitcher')->canUserSwitch()) {
            if ($this->owner instanceof LeftAndMain) {
                Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
                Requirements::javascript(THIRDPARTY_DIR . '/jquery-entwine/dist/jquery.entwine-dist.js');
                Requirements::javascript(FRAMEWORK_DIR  . '/javascript/jquery-ondemand/jquery.ondemand.js');
                Requirements::javascript(USERSWITCHER    . '/javascript/userswitcher.js');
                Requirements::css(USERSWITCHER . '/css/userswitcher-admin.css');
            } else {
                Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
                Requirements::javascript(USERSWITCHER    . '/javascript/userswitcher.js');
                Requirements::css(USERSWITCHER . '/css/userswitcher-front.css');
            }
        }
    }

    public function UserSwitcherFormHTML()
    {
        if (!singleton('UserSwitcher')->canUserSwitch()) {
            return;
        }
        return singleton('UserSwitcherController')->UserSwitcherForm()->forTemplate();
    }
}
