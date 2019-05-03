<?php
class Response {
    private $success;   // Success response
    private $code;      // Error code, should be 0 if everything went well
    private $messages;  // Resonse messages linked to $code
    private $data;      // Response of the request, or the data that we want to share

    public function __construct(){
        $this->success      = false; // default
        $this->code         = 0x0;
        $this->messages     = [];
        $this->data         = null;
    }

    public function addMessage($message){ // add message in the var
        return array_push($this->messages, $message);
    }

    public function setData($data){ //set response data
        return $this->data = $data;
    }

    public function setCode($code){ //set response code
        return $this->code = $code;
    }

    public function setSuccess($success){ //set success
        return $this->success = $success;
    }

    public function info(){
        return (object) [
            'success'   => $this->success,
            'code'      => $this->code,
            'messages'  => $this->messages,
            'data'      => $this->data
        ];
    }

}
