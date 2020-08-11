<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Provincia;
use App\Entity\Partido;

/**
 * @Route("/api", name="api")
 */

class ApiController extends AbstractController
{
    
   
    /**
    * @Route("/provincias", name="_get_provincias", methods={"GET"})
   */
  public function getProvincias()
  {
      $pcias=$this->getDoctrine()->getManager()->getRepository(Provincia::class)->findAll();
      return new jsonResponse($pcias);
  }

    /**
     * @Route("/provincias/{id}", name="_get_pciaxid", methods={"GET"})
     */
    //buscar por un parametro
    public function getPciaxid($id)
    {
        
        $pcia=$this->getDoctrine()->getManager()->getRepository(Provincia::class)->find($id);
        if (is_null($pcia)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($pcia);
       
      
    } 

     /**
     * @Route("/provincia", name="_get_pciaxnom", methods={"GET"})
     */
    //si dejo provincias no me anda y no entiendo porque?
    public function getPciaxnom(Request $request)
    {
        $nombre=$request->query->get('nombre');
        $query=['nombre'=>$nombre];

        $pcia=$this->getDoctrine()->getManager()->getRepository(Provincia::class)->findBy($query);
        if (is_null($pcia)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($pcia);
       
      
    } 

    
    /**
    * @Route("/partidos", name="_get_partidos", methods={"GET"})
    */
  public function getPartidos()
  {
      $partidos=$this->getDoctrine()->getManager()->getRepository(Partido::class)->findAll();
      return new jsonResponse($partidos);
  }

    /**
     * @Route("/partidos", name="_get_partidosxid", methods={"GET"})
     */
    //buscar por un parametro idpcia
    public function getPartidosxid(Request $request)
    {
        
        $provincia=$request->query->get('idpcia'); 
        $query=['provincia'=>$provincia];
        
       
        $partidos=$this->getDoctrine()->getManager()->getRepository(Partido::class)->findBy($query, array('nombre' => 'ASC'));   
        if (is_null($partidos)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($partidos);
       
      
    } 
    
 /**
     * @Route("/partido", name="_get_partido", methods={"GET"})
     */
    //buscar por un parametro idpcia,idpartido
    public function getPartido(Request $request)
    {
        
        $provincia=$request->query->get('idpcia'); 
        $partido=$request->query->get('idpartido');

        $query=[
            'provincia'=>$provincia,
            'id'=>$partido
          ];
        
         
        $partido=$this->getDoctrine()->getManager()->getRepository(Partido::class)->findBy($query);   //findBy( array(), array('nombre' => 'ASC') );
        if (is_null($partido)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($partido);
       
      
    }  
 

}
