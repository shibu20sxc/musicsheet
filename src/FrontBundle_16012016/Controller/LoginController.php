<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller {

    public function frontHomeAction(Request $request) {
        $conn = $this->get('database_connection');
        $info = $conn->fetchAll('SELECT * FROM log_info where status = "1" AND is_deleted = "1" order by id DESC ');
        $json_info = json_encode($info);
        return $this->render('FrontBundle:Login:frontHome.html.php', array( 'info' => $json_info ));
    }
    
    
    public function indexAction(Request $request) {
        $conn = $this->get('database_connection');
        $info = $conn->fetchAll('SELECT * FROM log_info where status = "1" AND is_deleted = "1" order by id DESC ');
        $json_info = json_encode($info);
        if ($request->getMethod() == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $users = $conn->fetchAll('SELECT * FROM users where email = "' . $email . '" AND password = "' . md5($password) . '" AND status = "1" AND is_deleted = "1" ');
            
            if (!empty($users)) {
                $users_session_array = array(
                    'login_users_id' => $users[0]['id'],
                    'login_users_name' => $users[0]['name']
                );
                $this->get('session')->set('users_session', $users_session_array);
                return new RedirectResponse($this->generateUrl('_front_dashboard'));
            } else {
                return $this->render('FrontBundle:Login:index.html.php', array('user_login' => 'Invalid username/password.', 'info' => $json_info ));
            }
        } else {
            
            return $this->render('FrontBundle:Login:index.html.php', array( 'info' => $json_info ));
        }
    }
    
     public function logoutAction() {       
        $session = $this->get('session');
        $ses_vars = $session->all();
        foreach ($ses_vars as $key => $value) {
            $session->remove($key);
        }
        return new RedirectResponse($this->generateUrl('_front_login'));
    }
    
    public function registerAction(Request $request) {
        $conn = $this->get('database_connection');
        if ($request->getMethod() == 'POST') {
            //print_r($_POST);die;
            $data = array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'is_deleted' => 1,
                'status' => 1
            );
            $conn->insert('users',$data);
            $data_log = array(
                'log_date' => date("m/d/Y"),
                'log_time' => time(),
                'details'  => "New user register ",
                'is_deleted' => 1,
                'status' => 1
            );
            $conn->insert('log_info',$data_log);
            //return new RedirectResponse($this->generateUrl('_front_login'));
            return new RedirectResponse($this->generateUrl('_front_login', array('register' => 'RegisterSuccess')));
        } else {
            return $this->render('FrontBundle:Login:register.html.php', array( ));
        }
    }
    
    public function ajaxUserEmailCheckAction(Request $request) {
        $conn = $this->get('database_connection');
        if ($request->getMethod() == "POST") {
            $email = $_POST['email_id'];
            $user_data = $conn->fetchAll('SELECT id FROM users WHERE  email = "' . $email . '"');
            $html = '';
            if (!empty($user_data)) {
                $html.= 'error';
            } else {
                $html.= 'success';
            }
            echo $html;
            exit();
        }
    }

    public function userForgetPasswordAction(Request $request) {
        $conn = $this->get('database_connection');
        if ($request->getMethod() == 'POST') {
            $data = $request->request->all();
            $email = $data['email'];
            $users = $conn->fetchAll('SELECT * FROM users WHERE email = "' . $email . '"');
            if (!empty($users)) {
                $time = time();
                $database_number = ($time * $users[0]['id']);
                $number = ($time * $users[0]['id']) - 37856;
                //print_r($number); die;
                $create = array(
                    'forget_password_otp' => $database_number
                );
                $conn->update('users', $create, array('id' => $users[0]['id']));
                $siteurl = $this->get('request')->getSchemeAndHttpHost() . $this->generateUrl('_user_forget_password_change', array('slug' => $number));
                //print_r($siteurl);die;
                $to = $users[0]['email'];
                $subject = 'Forget password Link';
                $message = 'Dear User,<br><br>Your Change password link  is : <a href = "' . $siteurl . '">Here</a>';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                $headers.='From: info@sheetmusic.com' . "\r\n" .
                        'Reply-To: info@sheetmusic.com' . "\r\n";


                mail($to, $subject, $message, $headers);
                return new RedirectResponse($this->generateUrl('_user_forget_password', array('msg_success' => 'Check your mail.We send your change password link.')));
            } else {
                return new RedirectResponse($this->generateUrl('_user_forget_password', array('msg_error' => 'Your email is not found in our database.')));
            }
        } else {
            return $this->render('FrontBundle:Login:userForgetPassword.html.php', array());
        }
    }

    public function userForgetPasswordChangeAction(Request $request) {

        if ($_POST) {
            $number = $_POST['hid_id'] + 37856;
            $conn = $this->get('database_connection');
            $users = $conn->fetchAll('SELECT * FROM users where forget_password_otp = "' . $number . '" ');
            if (!empty($users)) {
                $create = array(
                    'password' => md5($_POST['password'])
                );
                $conn->update('users', $create, array('id' => $users[0]['id']));
                return new RedirectResponse($this->generateUrl('_user_forget_password_change', array('msg_success' => 'Change your password successfully.')));
            } else {
                return new RedirectResponse($this->generateUrl('_user_forget_password_change', array('msg_success' => 'Change your password not successfully.')));
            }
        } else {
            $current_url = $this->getRequest()->getBaseUrl();
            return $this->render('FrontBundle:Login:userChangeForgetPassword.html.php', array('actionUrl' => $current_url));
        }
    }

}
