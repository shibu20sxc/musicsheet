<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CommonController extends Controller {

    public function statusUpdateAction() {
        if ($_POST) {
            $id = $_POST['dataId'];
            $table = $_POST['table'];
            $conn = $this->get('database_connection');
            $status_array = $conn->fetchAll('SELECT status FROM `' . $table . '` where id = "' . $id . '"');
            if ($status_array[0]['status'] == 1) {
                $create = array(
                    'status' => 0
                );
                $conn->update($table, $create, array('id' => $id));
                $status = '1';
            } else {
                $create = array(
                    'status' => 1
                );
                $conn->update($table, $create, array('id' => $id));
                $status = '2';
            }
            echo $status;
            exit();
        }
    }

    public function deleteUpdateAction($id, $table, $route) {
        $conn = $this->get('database_connection');
        $create = array(
            'is_deleted' => 0
        );
        $conn->update($table, $create, array('id' => $id));
        return new RedirectResponse($this->generateUrl($route));
    }

}
