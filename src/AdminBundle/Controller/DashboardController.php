<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        //print_r("suman"); die;
        return $this->render('AdminBundle:Dashboard:index.html.php', array('name' => 'name'));
    }
}
