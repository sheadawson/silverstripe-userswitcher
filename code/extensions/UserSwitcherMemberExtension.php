<?php
/**
 * Clears the UserSwitched session variable on member logout
 *
 * @author Shea Dawson <shea@silverstripe.com.au>
 * @license BSD http://silverstripe.org/bsd-license/
 */
class UserSwitcherMemberExtension extends DataExtension {

	public function memberLoggedOut(){
		Session::clear('UserSwitched');
	}
}
