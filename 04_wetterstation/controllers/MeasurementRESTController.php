<?php

require_once('RESTController.php');
require_once('models/Measurement.php');

class MeasurementRESTController extends RESTController{

    public function handleRequest(){
        switch($this->method){
            case 'GET':
                $this->handleGETRequest();
                break;
            case 'POST':
                $this->handlePOSTRequest();
                break;
            case 'PUT':
                    $this->handlePUTRequest();
                    break;
            case 'DELETE':
                    $this->handleDELETERequest();
                    break;
            default:
                    $this->response('Method Not Allowed'. 405);
        }
    }

    public function handleGETRequest(){
        if($this->verb == null && sizeof($this->args) == 0){
            $model = Measurement::getAll();
            $this->response($model);
        }elseif($this->verb == null && sizeof($this->args) == 1){
            $model = Measurement::get($this->args[0]);

            if($model == null){
                $this->response('Not found', 404);
            }else{
                $this->response($model);
            }
        }else{
            $this->response('Bad Request', 400);
        }
    }

    public function handlePOSTRequest(){
        $model = new Measurement();

        $model->setTime($this->getDataOrNull('time'));
        $model->setTemperature($this->getDataOrNull('temperature'));
        $model->setRain($this->getDataOrNull('rain'));
        $model->setStationId($this->getDataOrNull('station_id'));

        if($model->save()){
            $this->response('Created'. 201);
        }else{
            $this->response($model->getErrors(), 400);
        }

    }

    public function handlePUTRequest(){
        if($this->verb == null && sizeof($this->args) == 1){
            $model = Measurement::get($this->args[0]);

            if($model == null){
                $this->response('Not found', 404);
            }else{
                $model->setTime($this->getDataOrNull('time'));
                $model->setTemperature($this->getDataOrNull('temperature'));
                $model->setRain($this->getDataOrNull('rain'));
                $model->setStationId($this->getDataOrNull('station_id'));

                if($model->save()){
                    $this->response('Ok', 200);
                }else{
                    $this->response($model->getErrors(), 400);
                }
            }
        }

    }

    public function handleDELETERequest(){
        if($this->verb == null && sizeof($this->args) == 1){
            Measurement::delete($this->args[0]);
            $this->response('Ok', 200);
        }else{
            $this->response('Not found', 404);
        }

    }

}