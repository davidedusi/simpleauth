<?php
namespace AppBundle\Helper;

class Api
{
    protected $content;

    protected $status_code;

    public function setContent($data)
    {
        $this->content = $data;
    }
    public function setStatusCode($data)
    {
        $this->status_code = $data;
    }
    public function toArray()
    {
        return (array) $this;
    }
}