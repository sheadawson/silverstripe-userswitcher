<?php
/**
 * Provides a UserSwitcherForm on Controller 
 *
 * @author Shea Dawson <shea@silverstripe.com.au>
 * @license BSD http://silverstripe.org/bsd-license/
 */
class UserSwitcherControllerExtension extends Extension{

	private static $default_css = true;
	private static $default_js = true;

	public static $allowed_actions = array(
		'UserSwitcherForm'
	);

	public function UserSwitcherForm(){
		if(Director::isLive()){
			return false;
		}

		if(Permission::check('ADMIN') || Session::get('UserSwitched')){
			if(self::$default_css){
				Requirements::css(USERSWITCHER . '/css/userswitcher.css');	
			}

			if(self::$default_js){
				Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');	
				Requirements::javascript(USERSWITCHER . '/javascript/userswitcher.js');	
			}

			$members = Member::get()->map()->toArray();
		
			$fields = FieldList::create(
				DropdownField::create('MemberID', 'User:', $members, Member::currentUserID())
			);

			$actions = FieldList::create(
				FormAction::create('switchuser', 'Switch User')
			);

			$validator = RequiredFields::create(
				'MemberID'
			);

			return Form::create($this->owner, 'UserSwitcherForm', $fields, $actions, $validator)
				->addExtraClass('userswitcher');
		}
	}

	public function switchuser($data, $form){
		if(Permission::check('ADMIN') || Session::get('UserSwitched')){	
			if($member = Member::get()->byID((int)$data['MemberID'])){
				$member->logIn();
				Session::set('UserSwitched', 1);
				return $this->owner->redirectBack();
			}
		}else{
			return $this->owner->httpError('404');
		}
	}
}