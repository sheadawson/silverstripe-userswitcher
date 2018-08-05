<?php

namespace SheaDawson\UserSwitcher;

use SheaDawson\UserSwitcher\UserSwitcher;
use SilverStripe\Security\Member;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Security\IdentityStore;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Form;
use SilverStripe\Control\Controller;

/**
 * UserSwitcherController
 *
 * @author Shea Dawson <shea@livesource.co.nz>
 * @license BSD http://silverstripe.org/bsd-license/
 */
class UserSwitcherController extends Controller
{
    const URLSegment = 'userswitcher';

    private static $allowed_actions = array(
        'UserSwitcherForm',
    );

    public function index()
    {
        die('d');
    }

    public function UserSwitcherForm()
    {
        die('here');
        if (!UserSwitcher::singleton()->canUserSwitch()) {
            return;
        }

        $members = Member::get()->sort('Firstname ASC')->map()->toArray();

        if (isset($_GET['userswitchercms']) && $_GET['userswitchercms'] == 1) {
            $field = DropdownField::create('MemberID', '', $members)
                ->setEmptyString(_t('UserSwitcherController.SwitchUser', 'Switch User'));
        } else {
            $field = DropdownField::create('MemberID', _t('UserSwitcherController.SwitchUser', 'Switch User') . ':', $members, Member::currentUserID());
        }

        $fields = FieldList::create($field);

        $actions = FieldList::create(
            FormAction::create('switchuser', 'Switch User')
        );

        $validator = RequiredFields::create(
            'MemberID'
        );

        return Form::create($this, 'UserSwitcherForm', $fields, $actions, $validator)
            ->addExtraClass('userswitcher');
    }

    public function switchuser($data, $form)
    {
        if (singleton('SheaDawson\UserSwitcher\UserSwitcher')->canUserSwitch()) {
            $memberID = isset($data['MemberID']) ? (int)$data['MemberID'] : 0;
            $member = Member::get()->byID($memberID);
            if ($member) {
                $this->getRequest()->getSession()->set('UserSwitched', 1);
                $identityStore = Injector::inst()->get(IdentityStore::class);
                $identityStore->logIn($member, false, $this->getRequest());
                return $this->redirectBack();
            }
        } else {
            return $this->httpError('404');
        }
    }

    public function Link($action = '')
    {
        return self::URLSegment . '/' . $action;
    }
}
