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
        
        if ($this->provideUserSwitcher()) {
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
        //$isCMS = (int)$this->owner->getRequest()->getVar('userswitchercms') == 1;
        return singleton('UserSwitcherController')->UserSwitcherForm()->forTemplate();
    }

    public function provideUserSwitcher()
    {
        return !Director::isLive() && (Permission::check('ADMIN') || Session::get('UserSwitched'));
    }
}
