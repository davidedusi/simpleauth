<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Api;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends FOSRestController
{
    public function getHelloAction()
    {
        $response = new Api();

        $response->setStatusCode(Response::HTTP_OK);
        $response->setContent("Hello World");

        return $response->toArray();
    }
}