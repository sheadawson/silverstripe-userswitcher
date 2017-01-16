<?php

class UserSwitcher extends Object
{
    public function canUserSwitch()
    {
        return Director::isDev() && (Session::get('UserSwitched') || Permission::check('ADMIN'));
    }
}
