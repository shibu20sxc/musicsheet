<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\MusicFamily;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MusicFamilyController extends Controller {

    public function indexAction() {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $music_family = $this->getDoctrine()->getRepository('AdminBundle:MusicFamily')->findBy(array('isDeleted' => '1'));
            return $this->render('AdminBundle:MusicFamily:index.html.php', array('music_family' => $music_family));
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

    public function addFamilyAction() {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            if ($_POST) {
                $music_family = new MusicFamily();
                $music_family->setName($_POST['name']);
                $music_family->setDetails($_POST['details']);
                $music_family->setStatus($_POST['status']);
                $music_family->setIsDeleted('1');
                $em = $this->getDoctrine()->getManager();
                $em->persist($music_family);
                $em->flush();
            }
            return $this->render('AdminBundle:MusicFamily:addFamily.html.php', array());
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

    public function updateFamilyAction($id) {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $music_family = $this->getDoctrine()->getRepository('AdminBundle:MusicFamily')->find($id);
            if ($_POST) {
                $music_family->setName($_POST['name']);
                $music_family->setDetails($_POST['details']);
                $music_family->setStatus(1);
                $music_family->setIsDeleted('1');
                $em = $this->getDoctrine()->getManager();
                $em->persist($music_family);
                $em->flush();
                return new RedirectResponse($this->generateUrl('_view_music_family'));
            } else {

                if (!$music_family) {
                    throw $this->createNotFoundException('No data found for id ' . $id);
                }
                return $this->render('AdminBundle:MusicFamily:updateFamily.html.php', array('music_family' => $music_family));
            }
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

}
