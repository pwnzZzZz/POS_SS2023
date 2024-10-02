<?php

abstract class RESTController
{
    /**
     * Property: method
     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
     */
    protected $method = '';

    /**
     * Property: endpoint
     * The Model requested in the URI. eg: /files
     */
    protected $endpoint = '';

    /**
     * Property: verb
     * An optional additional descriptor about the endpoint, used for things that can
     * not be handled by the basic methods. eg: /files/process
     */
    protected $verb = '';

    /**
     * Property: args
     * Any additional URI components after the endpoint and verb have been removed, in our
     * case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
     * or /<endpoint>/<arg0>
     */
    protected $args = Array();

    /**
     * Property: file
     * Stores the input of the PUT request
     */
    protected $file = Null;

    /**
     * Constructor: __construct
     * Allow for CORS, assemble and pre-process the data
     */
    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");

        //Get arguments from URL
        $this->args = isset($_GET['r']) ? explode('/', trim($_GET['r'], '/')) : [];
        if (sizeof($this->args) == 0) {
            throw new Exception('Bad Request', 400);
        }

        //Get endpoint-Name form URL
        $this->endpoint = array_shift($this->args);
        if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
            $this->verb = array_shift($this->args);
        }

        //Sets the HTTP-Method, found in Clients request
        $this->method = $_SERVER['REQUEST_METHOD'];

        //Special treatment for special Clients: if HTTP-DELETE oder PUT ist hidden in HTTP-Post
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception('Method Not Allowed', 405);
            }
        }

        //
        switch ($this->method) {
            case 'DELETE':
            case 'POST':
                //Gets body from Clients request as JSON
                $this->file = json_decode(file_get_contents("php://input"), true);
                break;
            case 'GET':
                break;
            case 'PUT':
                //Gets body from Clients request as JSON
                $this->file = json_decode(file_get_contents("php://input"), true);
                break;
            default:
                throw new Exception('Method Not Allowed', 405);
        }
    }

    /**
     * helper method for extraction POST/PUT data
     * @param $field
     * @return mixed|null
     */
    protected function getDataOrNull($field) {
        return isset($this->file[$field]) ? $this->file[$field] : null;
    }

    public abstract function handleRequest();

    protected function response($data, $status = 200)
    {
        RESTController::responseHelper($data, $status);
    }

    public static function responseHelper($data, $status) {
        header("HTTP/1.1 " . $status . " " . RESTController::requestStatus($status));
        echo json_encode($data);
    }


    private static function requestStatus($code)
    {
        $status = array(
            200 => 'OK',
            201 => 'Created',
            400 => 'Bad Request',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return key_exists($code, $status) ? $status[$code] : $status[500];
    }
}
