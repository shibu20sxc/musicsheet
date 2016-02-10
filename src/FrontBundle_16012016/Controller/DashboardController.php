<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class DashboardController extends Controller {

    public function indexAction() {
        $conn = $this->get('database_connection');
        $candateDetails = $this->get('session')->get('users_session');
        $subscribed_user_id = $conn->fetchAll('SELECT subscription_user_id FROM subscribes WHERE login_user_id = "' . $candateDetails['login_users_id'] . '"');        
        if (!empty($candateDetails)) {
            $user_info = array();
            if (!empty($subscribed_user_id)) {
                foreach ($subscribed_user_id as $key => $sub_id) {
                    $subid_array[$key] = $sub_id['subscription_user_id'];
                }
                $condition = '';
                if (!empty($subid_array)) {
                    $condition = implode(',', $subid_array);
                }
                
                $user_info = $conn->fetchAll('SELECT li.details,u.name FROM log_info li LEFT JOIN users u ON u.id = li.userid WHERE li.userid in  (' . $condition . ') ORDER BY li.id');
              // echo 'SELECT li.details,u.name FROM log_info li LEFT JOIN users u ON u.id = li.userid WHERE li.userid in  (' . $condition . ') ORDER BY li.id';
                }
            
            $info = $conn->fetchAll('SELECT * FROM log_info where status = "1" AND is_deleted = "1" order by id DESC ');
            $json_info = json_encode($info);
            $json_user_info = json_encode($user_info);
            return $this->render('FrontBundle:Dashboard:index.html.php', array('info' => $json_info, 'subscription_details' => $json_user_info));
        } else {
            return new RedirectResponse($this->generateUrl('_front_login'));
        }
    }

}
