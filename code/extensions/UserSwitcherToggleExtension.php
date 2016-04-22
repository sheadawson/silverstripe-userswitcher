<?php
/**
 * Toggles the UserSwitcher on the frontend
 *
 */
class UserSwitcherToggleExtension extends DataExtension
{
    /**
     * @var array
     */
    private static $db = [
        'Toggle' => 'Boolean'
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Main", CheckboxField::create("Toggle", "Show User Switcher on frontend"));
    }
}
