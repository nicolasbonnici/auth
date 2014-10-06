<?php
namespace bundles\auth\Models;

use \Library\Core\Validator as Validator;
use Library\Core\Mail;
use bundles\user\Entities\User;
use Library\Core\App;

/**
 *
 * @author info
 */
class Auth
{
    /**
     * Required registration fields
     * @var array
     */
    private $aRequiredRegistrationFields = array(
    	'firstname',
    	'lastname',
    	'email',
    	'password1',
    	'password2'
    );

    /**
     * Instance constructor
     *
     * @param array $aExtraRequiredFields Add extra required fields
     */
    public function __construct(array $aExtraRequiredFields = array())
    {
        // Required registration parameters overide
        if (count($aExtraRequiredFields) > 0) {
            foreach ($aExtraRequiredFields as $sKey) {
                $this->aRequiredRegistrationFields[] = $sKey;
            }
        }
    }

    /**
     * Login a user
     * @return boolean
     */
    public function login(array $aCredentials)
    {
        $oUser = new User();
        try {
            $oUser->loadByParameters(array(
                'mail' => $aCredentials['email'],
                'pass' => $this->formatPassword($aCredentials['password'])
            ));
            if ($oUser->isLoaded()) {

                // Set user's lastlogin field
                $oUser->lastlogin = time();

                // Unset user's password
                $oUser->pass = null;

                foreach ($oUser as $key => $mValue) {
                    $_SESSION[$key] = $mValue;
                }

                return true;
            }
            return false;
        } catch (\Library\Core\EntityException $oException) {
            return false;
        }
    }

    /**
     * Register a new user
     * @param boolean|array     TRUE otherwhise an array of errors key for translation
     */
    public function register(array $aFormInfos)
    {
        $mCheck = $this->checkRegistrationFields($aFormInfos);
        if (is_array($mCheck)) {
            return $mCheck;
        } else {
            try {
                $oUser = new User();
                $oUser->email = $aFormInfos['email'];
                $oUser->firstname = $aFormInfos['firstname'];
                $oUser->lastname = $aFormInfos['lastname'];
                $oUser->pass = $this->formatPassword($aFormInfos['password1']);
                $oUser->mail = $aFormInfos['email'];
                $oUser->created = time();
                if ($oUser->add()) {
                    $this->sendConfirmationMail($oUser);
                }
            } catch (\Library\Core\EntityException $oException) {
                return $mCheck;
            }
        }
    }

    /**
     * Return hashed and salted password
     *
     * @param string $sPassword
     * @return string
     */
    public function formatPassword($sPassword)
    {
        $aConfig = App::getConfig();
        return hash('sha256',  $aConfig['app']['secret_key'] . $sPassword);
    }

    /**
     * Check required registration fields
     *
     * @param array $aRegistrationFields
     * @return mixed boolean|array    TRUE otherwhise an array of error fields
     */
    private function checkRegistrationFields(array $aRegistrationFields)
    {
        $aErrorFields = array();

        // Check required fields for registration
        foreach ($this->aRequiredRegistrationFields as $sKeyName) {
            if (! array_key_exists($sKeyName, $aRegistrationFields)) {
                $aErrorFields[] = $sKeyName . '_error';
            }
        }

        // Check email fields
        if (Validator::email($aRegistrationFields['email']) !== Validator::STATUS_OK) {
            $aErrorFields[] = 'email_error';
        }

        // Check password and confirmation
        if (
            $aRegistrationFields['password1'] !== $aRegistrationFields['password2'] ||
            Validator::password($aRegistrationFields['password1']) !== Validator::STATUS_OK ||
            Validator::password($aRegistrationFields['password2']) !== Validator::STATUS_OK
        ) {
            $aErrorFields[] = 'password_error';
        }

        return ((count($aErrorFields) === 0) ? true : $aErrorFields);
    }

    /**
     * Send a registration confirmation email
     * @param User $oUser
     */
    private function sendConfirmationMail(User $oUser)
    {

    }

}

class AuthModelException extends \Exception
{}

