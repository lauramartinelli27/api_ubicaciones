<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Provincia;
use App\Entity\Partido;
use App\Entity\Localidad;

/**
 * @Route("/api", name="api")
 */

class ApiController extends AbstractController
{
    
   //muestra todas las provincias de la tabla
    /**
    * @Route("/provincias", name="_get_provincias", methods={"GET"})
   */
  public function getProvincias()
  {
      $pcias=$this->getDoctrine()->getManager()->getRepository(Provincia::class)->findAll();
      return new jsonResponse($pcias);
  }

    //muestra la provincia del id ingresado
    /**
     * @Route("/provincias/{id}", name="_get_pciaxid", methods={"GET"})
     */
    
    public function getPciaxid($id)
    {
        
        $pcia=$this->getDoctrine()->getManager()->getRepository(Provincia::class)->find($id);
        if (is_null($pcia)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($pcia);
       
      
    } 

    //muestra la provincia por el nombre ingresado
    //si dejo provincias no me anda y no entiendo porque?
     /**
     * @Route("/provincia", name="_get_pciaxnom", methods={"GET"})
     */
    
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

    
    //muestra todos los partidos de la tabla
    /**
    * @Route("/partidos", name="_get_partidos", methods={"GET"})
    */
  public function getPartidos()
  {
      $partidos=$this->getDoctrine()->getManager()->getRepository(Partido::class)->findAll();
      return new jsonResponse($partidos);
  }

    //muestra los partidos para una provincia ingresada
    /**
     * @Route("/partidoss", name="_get_partidosxid", methods={"GET"})
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
    
    //muestra el partido por el id ingresado
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
 
    //muestra todas las localidades de la tabla
    /**
    * @Route("/localidades", name="_get_localidades", methods={"GET"})
    */
    public function getLocalidades()
    {
      $locs=$this->getDoctrine()->getManager()->getRepository(Localidad::class)->findAll();
      return new jsonResponse($locs);
    }

    
   //muestra la localidades de un partido por el id ingresado
   /**
    * @Route("/localidadess", name="_get_locxpartido", methods={"GET"})
    */
    public function getLocxpartido(Request $request)
    {
        
        $partido=$request->query->get('idpar'); 
        $query=['partido'=>$partido];
        
        $localidades=$this->getDoctrine()->getManager()->getRepository(Localidad::class)->findBy($query, array('nombre' => 'ASC'));   
        if (is_null($localidades)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($localidades);
       
    } 

    //muestra la localidad  por el id ingresado
    /**
     * @Route("/localidad", name="_get_localidad", methods={"GET"})
     */
    
    public function getLocalidad(Request $request)
    {
        
        $partido=$request->query->get('idpar'); 
        $localidad=$request->query->get('idloc');

        $query=[
            'partido'=>$partido,
            'id'=>$localidad
          ];
        
         
        $localidad=$this->getDoctrine()->getManager()->getRepository(Localidad::class)->findBy($query);   //findBy( array(), array('nombre' => 'ASC') );
        if (is_null($localidad)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($localidad);
       
      
    }  
}
