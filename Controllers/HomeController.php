<?php

namespace bundles\auth\Controllers;

/**
 * Auth HomeController
 *
 * @author info
 */
class HomeController extends \Library\Core\Controller {

    public function __preDispatch() {}

    public function __postDispatch() {}

    /**
     * Login form
     */
    public function indexAction()
    {
        // A session was already found so we redirect to root
        if (isset($_SESSION['token'])) {
            $this->redirect('/');
        }

        if (isset($this->_params['email']) && isset($this->_params['password'])) {

            if($this->login()) {
                $sRedirectUrl = '/todo/'; // @todo modifier ce chemin
                if (isset($this->_params['redirect']) && !empty($this->_params['redirect'])) {
                    $sRedirectUrl = str_replace('*', '/', urldecode($this->_params['redirect']));
                }
                $this->redirect($sRedirectUrl);
            }// @todo gestion erreur de login

        }

        $this->render('auth/index.tpl');
    }

    /**
     * Open a user session
     * @return boolean
     */
    protected function login()
    {
        $oUser = new \app\Entities\User();
        try {
            $oUser->loadByParameters(array(
                'mail' => $this->_params['email'],
                'pass' => hash('SHA256', $this->_params['password'])
            ));
            $oUser->pass = null;
            foreach ($oUser as $key=>$mValue) {
                $_SESSION[$key] = $mValue;
            }
            return true;
        } catch(\Library\Core\EntityException $oException) {
            return false;
        }
    }

}

?>
