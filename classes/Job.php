<?php

/**
 * Description of Job
 *
 * @author stefan
 */
class Job {

    private $mysql;

    public function __construct() {
        $this->mysqli = mysqli_connect('localhost', 'root', '1111', 'CayetanoTask');
    }

    public function index() {
        $response = new stdClass();

        $jobs = $this->mysqli->query('SELECT * FROM jobs');
        $allJobs = array();
        while ($row = $jobs->fetch_assoc()) {
            $allJobs[] = $row;
        }
        $response->status = 'ok';
        $response->data = $allJobs;

        echo json_encode($response);
    }

    public function show($id) {
        $response = new stdClass();

        $result = $this->mysqli->query('SELECT * FROM jobs WHERE id =' . $id);

        if (!$result) {
            $response->status = 'error';
            $response->message = 'Error';
        } else {
            $job = $result->fetch_row();
            if (!$job) {
                $response->status = 'error';
                $response->message = 'Error';
            } else {
                $response->status = 'ok';
                $response->data = $job;
            }
        }

        echo json_encode($response);
    }

}
