<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Provincia;

/**
 * @Route("/api", name="api")
 */

class ApiController extends AbstractController
{
    
   
    /**
    * @Route("/provincias", name="_list_provincias", methods={"GET"})
   */
  public function listProvincias()
  {
      $pcias=$this->getDoctrine()->getManager()->getRepository(Provincia::class)->findAll();
      return new jsonResponse($pcias);
  }
}
