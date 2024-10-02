<?php

require_once('RESTController.php');
require_once('models/Station.php');

class HomeRESTController extends RESTController {

    public function handleRequest() {
        switch ($this->method) {
            case 'GET':
                $this->handleGETRequest();
                break;
            default:
                $this->response('Method Not Allowed', 405);
                break;
        }
    }

    public function handleGETRequest() {
        if($this->verb == null && sizeof($this->args) == 0) {
            $model = Station::getAll();
            $this->response($model);
        }
    }
}