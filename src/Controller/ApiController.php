<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/api", name="api")
 */

class ApiController extends AbstractController
{
    
    /**
    * @Route("/provincias", name="list_provincias")
    */
    public function listProvincias()
    {
        $this->getDoctrine()->getManager
        return new JsonResponse();
    }
}
