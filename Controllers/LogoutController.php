<?php
namespace bundles\auth\Controllers;

/**
 * Auth LogoutController
 *
 * @author info
 */
class LogoutController extends \Library\Core\Controller
{

    public function __preDispatch()
    {}

    public function __postDispatch()
    {}

    /**
     * Logout
     */
    public function indexAction()
    {
        // @todo Cookie::delete() et setter une constante pour le nom de session via la config
        $oCookie = new \Library\Core\Cookie();
        // die(var_dump($oCookie->getCookieVar('PHPSESSID')));
        
        session_destroy();
        $this->redirect('/');
    }
}

?>
