<?php

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class AdvertisementController extends Controller
{
    public function indexAction(Request $request) {             
        
            $conn = $this->get('database_connection');
            if ($request->getMethod() == 'POST') {
                $data = $request->request->all();                
                $email = $data['ademail'];
                $question = $data['adqu'];
                $option = $data['option'];

                if ($option == "1") {
                    $option_value = "Option 1";
                } else if ($option == "2") {
                    $option_value = "Option 2";
                } else {
                    $option_value = "Option 3";
                }
                if (!empty($email)) {

                    $to = "suman.nisbusiness@gmail.com";
                    $subject = 'Advertisement Request';
                    $message = '<br> Email : ' . $email . '<br>Comment : ' . $question . ' ';

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                    $headers.='From: info@sheetmusic.com' . "\r\n" .
                            'Reply-To: info@sheetmusic.com' . "\r\n";


                    mail($to, $subject, $message, $headers);
                    return new RedirectResponse($this->generateUrl('_fornt_advertisement', array('msg_success' => 'Your Request sending successfully.We will reply you soon.')));
                } else {
                    return new RedirectResponse($this->generateUrl('_fornt_advertisement', array('msg_error' => 'Your Request not sending successfully.')));
                }
            } else {
                return $this->render('FrontBundle:Advertisement:index.html.php', array());
            }
        
    }

}
