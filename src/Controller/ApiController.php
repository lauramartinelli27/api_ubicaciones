<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Provincia;
use App\Entity\Partido;
use App\Entity\Localidad;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/api", name="api")
 */

class ApiController extends AbstractController
{

    public function __construct (EntityManagerInterface $em)
    {
       $this->em= $em;
    }

  
    
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
     * @Route("/provincias/{id}", name="_get_pciaxid", methods={"GET"}, requirements={"id"="\d+"})
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
     /**
     * @Route("/provincias/{nombre}", name="_get_pciaxnom", methods={"GET"})
     */
    public function getPciaxnom($nombre)
    {
      
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


    //muestra el partido del idpartido ingresado
    /**
     * @Route("/partido/{id}", name="_get_partidoxid", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getPpartidoxid($id)
    {
        
        $partido=$this->getDoctrine()->getManager()->getRepository(Partido::class)->find($id);
        if (is_null($partido)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($partido);
    } 


     //muestra los partidos para una povincia ingresada
    /**
     * @Route("/partidos/{idpcia}", name="_get_partidosxid", methods={"GET"}, requirements={"idpcia"="\d+"})
     */
    public function getPartidosxid($idpcia)
    {
        $query=['provincia'=>$idpcia];
        $partidos=$this->getDoctrine()->getManager()->getRepository(Partido::class)->findBy($query, array('nombre' => 'ASC'));   
        if (is_null($partidos)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($partidos);
       
    } 

    //muestra el partido por el idpartido e idprovincia ingresado
    /**
     * @Route("/partidos/{id}/{idpcia}", name="_get_partidoxpp", methods={"GET"})
     */
    public function getPartidoxpp($id,$idpcia)
    {
        
         $query=[
            'provincia'=>$idpcia,
            'id'=>$id
          ];
        
         
        $partido=$this->getDoctrine()->getManager()->getRepository(Partido::class)->findBy($query); 
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


    //muestra la localidad del idlocalidad ingresado
    /**
     * @Route("/localidad/{id}", name="_get_localidadxid", methods={"GET"}, requirements={"id"="\d+"})
    */
    public function getLocalidadxid($id)
    {
        
        $localidad=$this->getDoctrine()->getManager()->getRepository(Partido::class)->find($id);
        if (is_null($localidad)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($localidad);
    } 

    
    //muestra la localidades de un partido por el id ingresado
    /**
    * @Route("/localidades/{idpartido}", name="_get_localidadesxid", methods={"GET"}, requirements={"idpartido"="\d+"}))
    */
    public function getLocalidadesxid($idpartido)
    {
        
        $query=['partido'=>$idpartido];
        
        $localidades=$this->getDoctrine()->getManager()->getRepository(Localidad::class)->findBy($query, array('nombre' => 'ASC'));   
        if (is_null($localidades)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($localidades);
       
    } 

    //muestra la localidad  por el idprovincia,idpartido e idlocalidad ingresados
    /**
     * @Route("/localidades/{idpcia}/{idpartido}/{idlocalidad}", name="_get_localidadxppl", methods={"GET"})
     */
    
    public function getLocalidadxppl($idpcia,$idpartido,$idlocalidad)
    {
        $conn = $this->em->getConnection();
    
       $sql="select po.id as idpcia,po.nombre as provincia,pa.id as idpartido,pa.nombre as partido,l.id as idlocalidad, l.nombre as localidad from Provincia po 
        left join partido pa on po.id=pa.provincia_id
        left join localidad l on pa.id=l.partido_id
        where po.id=$idpcia and pa.id=$idpartido and l.id=$idlocalidad";
        $respuesta= $conn->prepare($sql);
        $respuesta->execute();
        return new jsonResponse($respuesta->fetchAll());

        /*$conn=$this->getDoctrine()->getManager(); 
        $sql="select provincia.id as idpcia,provincia.nombre as prov,partido.id as idpartido,partido.nombre as part,localidad.id as idloc, localidad.nombre as loc from App:Provincia provincia join App:Partido partido join App:Localidad localidad localidad.partido_id where provincia.id=:idpcia and partido.id=:idpartido and localidad.id=:idlocalidad";
        $localidad=$conn->createQuery($sql); //dd($localidad);
        $localidad->setParameter('idpcia', $idpcia);
        $localidad->setParameter('idpartido', $idpartido);
        $localidad->setParameter('idlocalidad', $idlocalidad);
        $respuesta=$localidad->getResult();
        return new jsonResponse($respuesta);*/
           
    } 


//muestra la localidad  por el idpartido e idlocalidad ingresados
    /**
     * @Route("/localidades/{idpartido}/{idlocalidad}", name="_get_localidadxpl", methods={"GET"})
     */
    
    public function getLocalidadxpl($idpartido,$idlocalidad)
    {
        
       
         $query=[
            'partido'=>$idpartido,
            'id'=>$idlocalidad
          ];
        
         
        $localidad=$this->getDoctrine()->getManager()->getRepository(Localidad::class)->findBy($query);   //findBy( array(), array('nombre' => 'ASC') );*/
        if (is_null($localidad)){
            throw $this->createNotFoundException();

        }
        return new jsonResponse($localidad);
       
    
    }  


}

