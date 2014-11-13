<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
//        $jobs = mysqli_query($this->connection,'SELECT * FROM jobs');
        $allJobs = array();
        while ($row = $jobs->fetch_assoc()) {
            $allJobs[] = $row;
        }
        $response->data = $allJobs;        
        
        echo json_encode($response);
    }

    public function show($id) {
        $response = new stdClass();
        
        $result = $this->mysqli->query('SELECT * FROM jobs WHERE id =' . $id);
        
        if (!$result) {
            $response->message = 'Error';
        } else {
            $job = $result->fetch_row();
            if (!$job) {
                $response->message = 'Error';
            } else {
                $response->data = $job;
            }
        }        

        echo json_encode($response);
    }

}
