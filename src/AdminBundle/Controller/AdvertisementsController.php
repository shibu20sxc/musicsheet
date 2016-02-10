<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Cookie;

class AdvertisementsController extends Controller {

    public function indexAction() {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $conn = $this->get('database_connection');
            $advertisements = $conn->fetchAll('SELECT * FROM advertisements WHERE is_deleted = "1"');
            return $this->render('AdminBundle:Advertisements:index.html.php', array('advertisements' => $advertisements));
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

    public function addAdvertisementsAction(Request $request) {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $conn = $this->get('database_connection');
            if ($request->getMethod() == "POST") {
                if ($_POST['type'] == 2) {
                    $create = array(
                        'advetisements_type' => $_POST['advetisements_type'],
                        'advertisements' => $_POST['advertisements_link'],
                        'details' => $_POST['details'],
                        'status' => $_POST['status']
                    );
                }
                if ($_POST['type'] == 1) {
                    $create = array(
                        'advetisements_type' => $_POST['advetisements_type'],
                        'details' => $_POST['details'],
                        'status' => $_POST['status']
                    );
                    $image = $request->files->get('adv_image');
                    if (($image instanceof UploadedFile) && ($image->getError() == '0')) {
                        if (($image->getSize() < 2000000)) {
                            $originalName = $image->getClientOriginalName();

                            $name_array = explode(".", $originalName);
                            $file_type = $name_array[sizeof($name_array) - 1];
                            $valid_filetypes = array('jpg', 'jpeg', 'bmp', 'png');
                            if (in_array(strtolower($file_type), $valid_filetypes)) {
                                foreach ($request->files as $uploadedFile) {
                                    $directory = $this->getUploadRootDir() . '/advertisements';
                                    $name_image = time() . '_' . $uploadedFile->getClientOriginalName();
                                    $file = $uploadedFile->move($directory, $name_image);
                                }
                            } else {
                                $fileTypeError = TRUE;
                                return $this->render('AdminBundle:Advertisements:addAdvertisements.html.php', array('fileTypeError' => $fileTypeError));
                            }
                        } else {
                            $fileSizeError = TRUE;
                            return $this->render('AdminBundle:Advertisements:addAdvertisements.html.php', array('fileSizeError' => $fileSizeError));
                        }

                        $create['advertisements'] = $name_image;
                    } else {
                        $fileSizeError = TRUE;
                        return $this->render('AdminBundle:Advertisements:addAdvertisements.html.php', array('fileSizeError' => $fileSizeError));
                    }
                }

                $conn->insert('advertisements', $create);
                return new RedirectResponse($this->generateUrl('view_advertisemets'));
            } else {
                return $this->render('AdminBundle:Advertisements:addAdvertisements.html.php', array());
            }
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

    public function updateAdvertisementsAction($id, Request $request) {
        $name = $this->get('session')->get('userdata');
        if (!empty($name)) {
            $conn = $this->get('database_connection');
            $getAdvertise = $conn->fetchAll('SELECT * FROM advertisements WHERE id = "' . $id . '"');
            if ($_POST) {
                if ($_POST['type'] == 2) {
                    $create = array(
                        'advetisements_type' => $_POST['advetisements_type'],
                        'advertisements' => $_POST['advertisements_link'],
                        'details' => $_POST['details'],
                        'status' => $_POST['status']
                    );
                }
                if ($_POST['type'] == 1) {
                    $create = array(
                        'advetisements_type' => $_POST['advetisements_type'],
                        'details' => $_POST['details'],
                        'status' => $_POST['status']
                    );
                    $image = $request->files->get('adv_image');
                    if (($image instanceof UploadedFile) && ($image->getError() == '0')) {
                        if (($image->getSize() < 2000000)) {
                            $originalName = $image->getClientOriginalName();

                            $name_array = explode(".", $originalName);
                            $file_type = $name_array[sizeof($name_array) - 1];
                            $valid_filetypes = array('jpg', 'jpeg', 'bmp', 'png');
                            if (in_array(strtolower($file_type), $valid_filetypes)) {
                                foreach ($request->files as $uploadedFile) {
                                    $directory = $this->getUploadRootDir() . '/advertisements';
                                    $name_image = time() . '_' . $uploadedFile->getClientOriginalName();
                                    $file = $uploadedFile->move($directory, $name_image);
                                }
                            } else {
                                $fileTypeError = TRUE;
                                return $this->render('AdminBundle:Advertisements:updateAdvertisements.html.php', array('fileTypeError' => $fileTypeError));
                            }
                        } else {
                            $fileSizeError = TRUE;
                            return $this->render('AdminBundle:Advertisements:updateAdvertisements.html.php', array('fileSizeError' => $fileSizeError));
                        }

                        $create['advertisements'] = $name_image;
                    } else {
                        $fileSizeError = TRUE;
                        return $this->render('AdminBundle:Advertisements:updateAdvertisements.html.php', array('fileSizeError' => $fileSizeError));
                    }
                }

                $conn->update('advertisements', $create, array('id' => $id));
                return new RedirectResponse($this->generateUrl('view_advertisemets'));
            } else {
                return $this->render('AdminBundle:Advertisements:updateAdvertisements.html.php', array('advertisements' => $getAdvertise));
            }
        } else {
            return new RedirectResponse($this->generateUrl('_admin_login'));
        }
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

}
