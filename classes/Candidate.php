<?php

/**
 * Description of Candidate
 *
 * @author stefan
 */
class Candidate {

    private $mysql;

    public function __construct() {
        $this->mysqli = mysqli_connect('localhost', 'root', '1111', 'CayetanoTask');
    }

    public function index() {
        $response = new stdClass();

        $jobs = $this->mysqli->query('SELECT * FROM candidates');
        $allCandidates = array();
        while ($row = $jobs->fetch_assoc()) {
            $allCandidates[] = $row;
        }
        $response->status = 'ok';
        $response->data = $allCandidates;

        echo json_encode($response);
    }

    public function show($id) {
        $response = new stdClass();
        $result = $this->mysqli->query('SELECT * FROM candidates WHERE id =' . $id);

        if (!$result) {
            $response->status = 'error';
            $response->message = 'Error';
        } else {
            $candidate = $result->fetch_row();
            if (!$candidate) {
                $response->status = 'error';
                $response->message = 'Error';
            } else {
                $response->status = 'ok';
                $response->data = $candidate;
            }
        }

        echo json_encode($response);
    }

    public function search($id) {
        $response = new stdClass();
        $result = $this->mysqli->query("SELECT * FROM candidates WHERE id LIKE '%" . $id . "%'");

        if (!$result) {
            $response->status = 'error';
            $response->message = 'Error';
        } else {
            $allCandidates = array();
            while ($row = $result->fetch_assoc()) {
                $allCandidates[] = $row;
            }
            $response->status = 'ok';
            $response->data = $allCandidates;
        }

        echo json_encode($response);
    }

}
