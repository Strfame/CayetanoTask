<?php

include 'classes/Url.php';
include 'classes/Job.php';
include 'classes/Candidate.php';

$url = new url('/CayetanoTask');

$page = $url->segment(1);
$jobs = new Job();
$candidates = new Candidate();

if ($page != false) {
    $category = $url->segment(2);    
    if ($page == 'jobs') {        
        if ($category == 'list') {            
            $jobs->index();
        } else if($category == false) {            
            echo '404 route not exist';
        } else {            
            $jobs->show($category);
        }
    } elseif($page == 'candidates') {
        $candidatId = $url->segment(3);
        switch ($category) {
            case 'list':
                $candidates->index();
                break;
            case 'review' :
                if ($candidatId == false) {
                   echo '404 route not exist';
                   break;
                }
                $candidates->show($candidatId);
                break;
            case 'search' :
                if ($candidatId == false) {
                   echo '404 route not exist';
                   break;
                }
                $candidates->search($candidatId);
                break;
            default :
                echo '404 route not exist';
                break;
        }       
        
    } else {
        echo '404 route not exist';
    }
}

