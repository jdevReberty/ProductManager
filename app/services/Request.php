<?php 

namespace app\services;

class Request {
    private $content;
    public function __construct(object $request)
    {
        $this->setContent($request);
    }

    private function setContent($content) {
        $this-> content = $content;
    }

    public function get(string $param) {
        return $this->content->$param;
    }
}