<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AdminBundle\Entity\MusicFamily;
use AdminBundle\Entity\FamilySound;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FamilySoundController extends Controller {

    public function indexAction() {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $conn = $this->get('database_connection');
            $music_sound = $conn->fetchAll('SELECT f.name as family, s.* FROM family_sound s
                         LEFT JOIN music_family f ON s.fid = f.id 
                         where s.is_deleted = 1');
            return $this->render('AdminBundle:FamilySound:index.html.php', array('music_sound' => $music_sound));
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

    public function addSoundAction(Request $request) {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $music_family = $this->getDoctrine()->getRepository('AdminBundle:MusicFamily')->findBy(array('isDeleted' => '1', 'status' => '1'));
            if ($request->getMethod() == 'POST') {

                $sound = new FamilySound();
                $sound->setFid($_POST['family_id']);
                $sound->setName($_POST['name']);
                $sound->setDetails($_POST['details']);
                $sound->setStatus($_POST['status']);
                $sound->setIsDeleted('1');
                $em = $this->getDoctrine()->getManager();
                $em->persist($sound);
                $em->flush();
                return new RedirectResponse($this->generateUrl('_add_sound'));
            } else {
                return $this->render('AdminBundle:FamilySound:addSound.html.php', array('families' => $music_family));
            }
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

    public function updateSoundAction($id, Request $request) {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $conn = $this->get('database_connection');
            if ($_POST) {
                $data = $request->request->all();
                $conn->update('family_sound', $data, array('id' => $id));
                return new RedirectResponse($this->generateUrl('_view_family_sound'));
            } else {
                $family_sound = $conn->fetchAll('SELECT * FROM family_sound WHERE id = "' . $id . '"');
                $music_family = $this->getDoctrine()->getRepository('AdminBundle:MusicFamily')->findBy(array('isDeleted' => '1', 'status' => '1'));
                return $this->render('AdminBundle:FamilySound:updateSound.html.php', array('families' => $music_family, 'family_sound' => $family_sound));
            }
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

}
