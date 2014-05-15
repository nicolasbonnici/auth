<?php
namespace bundles\auth\Controllers;

use bundles\error\Controllers\ErrorController;
/**
 * Auth HomeController
 *
 * @author info
 */
class HomeController extends ErrorController
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
        if (isset($this->aParams['redirect'])) {
            if (isset($this->aParams['redirect']) && ! empty($this->aParams['redirect'])) {
                $sRedirectUrl = str_replace('*', '/', urldecode($this->aParams['redirect']));
            }
            $this->aView['redirect'] = $this->aParams['redirect'];
        }

        // A session was already found so we redirect to root
        if (isset($_SESSION['token'])) {
            $this->redirect($sRedirectUrl);
        }


        if (isset($this->aParams['email']) && isset($this->aParams['password'])) {
            if ($this->login()) {
                $this->redirect($sRedirectUrl);
            } else {
                $this->aView['sError'] = 'Mauvais indentifiant'; // @todo Translate component
            }
        }

        $this->oView->render($this->aView, 'auth/index.tpl');
    }

    /**
     * Open a user session
     *
     * @return boolean
     */
    protected function login()
    {
        $oUser = new \app\Entities\User();
        try {
            $oUser->loadByParameters(array(
                'mail' => $this->aParams['email'],
                'pass' => hash('SHA256', $this->aParams['password'])
            ));
            if ($oUser->isLoaded()) {

                // Set user's lastlogin field
                $oUser->lastlogin = time();

                // Unset user's password
                $oUser->pass = null;

                foreach ($oUser as $key => $mValue) {
                    $_SESSION[$key] = $mValue;
                }
            }
            return true;
        } catch (\Library\Core\EntityException $oException) {
            return false;
        }
    }
}

