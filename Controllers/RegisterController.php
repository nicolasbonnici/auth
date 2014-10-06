<?php
namespace bundles\auth\Controllers;

use bundles\error\Controllers\ErrorController;
use bundles\auth\Models\Auth;
/**
 * Auth RegsiterController
 *
 * @author info
 */
class RegisterController extends ErrorController
{

    public function __preDispatch()
    {
        // overide appLayout view setting
        $this->aView["authLayout"] = 'authLayout.tpl';
    }

    public function __postDispatch()
    {}

    /**
     * Login form
     *
     * @param string $sRedirectUrl
     */
    public function indexAction($sRedirectUrl = '/')
    {
        if (
            isset($this->aParams['firstname']) &&
            isset($this->aParams['lastname']) &&
            isset($this->aParams['email']) &&
            isset($this->aParams['password1']) &&
            isset($this->aParams['password2'])
        ){
            // Register a new user
            $oAuthModel = new Auth();
            $this->aView['aRegisterErrors'] = $oAuthModel->register($this->aParams);
            $this->aView['bRegistrationStatus'] = (! is_array($this->aView['aRegisterErrors']));
        }

        $this->oView->render($this->aView, 'register/index.tpl');
    }

}

