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

    /**
     * @Route("/provincias/{id}", name="_buscar_pciaxid", methods={"GET"})
     */
    //buscar por un parametro
    public function buscarPciaxid($id)
    {
        
        $pcia=$this->getDoctrine()->getManager()->getRepository(Provincia::class)->find($id);
        if (is_null($pcia)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($pcia);
       
      
    }  
}
