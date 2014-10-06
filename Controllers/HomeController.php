<?php
namespace bundles\auth\Controllers;

use bundles\error\Controllers\ErrorController;
use bundles\auth\Models\Auth;
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
            $oAuthModel = new Auth();
            if ($oAuthModel->login($this->aParams)) {
                $this->redirect($sRedirectUrl);
            } else {
                // @todo internationnalisation
                $this->aView['sError'] = 'Une erreur est survenue: Votre adresse email ou votre mot de passe est incorrect.'; // @todo Translate component
            }
        }

        $this->oView->render($this->aView, 'home/index.tpl');
    }

}

