<?php

namespace App\Controller;
use App\Entity\{Pais,Region};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse,Response};
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;

class PaisController extends AbstractController
{
    
    // la ruta en el browser es /paises/region/, con los parametros opcionales region 
    #[Route('/pais/region/{codigoRegion}', name: 'filtroRegion', defaults: ['codigoRegion'=>null])]
    public function filtrarRegionPais($codigoRegion, ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        
        $paises=$doctrine->getRepository(Pais::class)->filtrarPaisesPorRegion($codigoRegion);
        

        if (!$paises) {
            throw $this->createNotFoundException(
                'No hay datos'
            );
        }
        
        $jsonContent = $serializer->serialize(array('data'=>$paises), 'json');
        return new Response($jsonContent);
    }

    // la ruta en el browser es /paises/nombre, con los parametros opcionales nombre pais
    #[Route('/pais/nombre/{nombrePais}', name: 'filtroNombrePais', defaults: ['nombrePais'=>null])]
    public function filtrarNombrePais($nombrePais, ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    { 
        $paises = $doctrine->getRepository(Pais::class)->filtrarNombre($nombrePais);

        if (!$paises) {
            throw $this->createNotFoundException(
                'No hay datos'
            );
        }
        
        $jsonContent = $serializer->serialize(array('data'=>$paises), 'json');
        return new Response($jsonContent);
    }
    
    // notese que el nombre del parametro codigoPais es el mismo de la variable en la funcion detallePais, es decir $codigoPais
    #[Route('/pais/{idPais}', name: 'detallePais', methods:['GET'])]
    public function detallePais(ManagerRegistry $doctrine,SerializerInterface $serializer, $idPais): Response
    {
        $pais = $doctrine->getRepository(Pais::class)->getDetallePais( $idPais);
        
        if (!$pais) {
            throw $this->createNotFoundException(
                'No hay datos'
            );
        }
        
        $jsonContent = $serializer->serialize(array('data'=>$pais), 'json');
        return new Response($jsonContent);
    }

    #[Route('/paises/', name: 'listaPaises')]
    public function listaPaises(ManagerRegistry $doctrine,SerializerInterface $serializer): Response
    {
        $paises = $doctrine->getRepository(Pais::class)->findAll();
      
        if (!$paises) {
            throw $this->createNotFoundException(
                'No hay datos'
            );
        }
       
        $jsonContent = $serializer->serialize(array('data'=>$paises), 'json');
        return new Response($jsonContent);
    }
}
