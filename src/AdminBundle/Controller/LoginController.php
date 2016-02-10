<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller {

    public function loginAction() {
        if ($_POST) {
            $conn = $this->get('database_connection');
            $users = $conn->fetchAll('SELECT * FROM admins where email = "' . $_POST['username'] . '" AND password = "' . md5($_POST['password']) . '" AND status = "1" AND is_deleted = "1" ');
            $count_user = count($users);
            if ($count_user > 0) {

                $user_session_array = array(
                    'login_user_id' => $users[0]['id'],
                    'login_user_name' => $users[0]['name']
                );
                $this->get('session')->set('userdata', $user_session_array);

                /* cookies implements */

                /* if (isset($_POST['remember_me'])) {
                  $response = new Response();
                  $value = array(
                  'adminemail' => $_POST['username'],
                  'password' => $_POST['password']
                  );
                  $cookie = new Cookie('admin_remember_cookies', serialize($value), (time() + 3600 * 24 * 7));
                  $response->headers->setCookie($cookie);
                  $response->send();
                  } */
                /* Cookies end */


                return new RedirectResponse($this->generateUrl('_dahboard_index'));
            } else {
                return new RedirectResponse($this->generateUrl('_admin_login', array('msg_success' => 'Connectez-vous pas réussie')));
            }
        } else {
            return $this->render('AdminBundle:Login:index.html.php', array('name' => 'name'));
        }
    }
    
    public function logoutAction() {       
        $session = $this->get('session');
        $ses_vars = $session->all();
        foreach ($ses_vars as $key => $value) {
            $session->remove($key);
        }
        return new RedirectResponse($this->generateUrl('_admin_login'));
    }

}
