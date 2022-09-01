<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PaisController extends AbstractController
{
    // la ruta en el browser es /paises/region/, con los parametros opcionales region 
    #[Route('/paises/region/{region}', name: 'filtroRegion', defaults: ['region'=>null])]
    public function filtrarRegionPais($region): JsonResponse
    {
        if ($region==null) $region="";
        // retorna un archivo json
        return $this->json([
            'region' => $region,
        ]);
    }

    // la ruta en el browser es /paises/nombre, con los parametros opcionales nombre pais
    #[Route('/paises/nombre/{nombrePais}', name: 'filtroNombrePais', defaults: ['nombrePais'=>null])]
    public function filtrarNombrePais( $nombrePais): JsonResponse
    {
        ($nombrePais==null)?$nombrePais="":null;
        // retorna un archivo json
        return $this->json([
            'nombre_pais' => $nombrePais,
        ]);
    }

    // notese que el nombre del parametro codigoPais es el mismo de la variable en la funcion detallePais, es decir $codigoPais
    #[Route('/paises/{codigoPais}', name: 'detallePais', methods:['GET'])]
    public function detallePais($codigoPais): JsonResponse
    {
        
        return $this->json([
            'message' => 'Welcome to your new controller! '.$codigoPais,
            'path' => 'src/Controller/PaisController.php',
        ]);
    }

    #[Route('/paises/', name: 'listaPaises', methods:['GET'])]
    public function lista(): JsonResponse
    {
        
        return $this->json([
            'message' => 'Welcome to your new controller! ',
            'path' => 'src/Controller/PaisController.php',
        ]);
    }
}
