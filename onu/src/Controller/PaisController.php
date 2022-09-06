<?php

namespace App\Controller;
use App\Entity\Pais;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
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
    #[Route('/pais/nombre/{nombrePais}', name: 'filtroNombrePais', defaults: ['nombrePais'=>null])]
    public function filtrarNombrePais($nombrePais, ManagerRegistry $doctrine): JsonResponse
    { 
        $pais = $doctrine->getRepository(Pais::class)->findOneBy(['nombre' => $nombrePais]);

        if (!$pais) {
            throw $this->createNotFoundException(
                'No hay datos'
            );
        }
        
        $result[] = array(
            'nombre' => $pais->getNombre(),
            'capital' => $pais->getCapital(),
            'poblacion' => $pais->getPoblacion(),
            'moneda' => $pais->getMoneda(),
            'idioma' => $pais->getIdioma(),
        );

        return $this->json(['pais'=>$result]);
    }

    // notese que el nombre del parametro codigoPais es el mismo de la variable en la funcion detallePais, es decir $codigoPais
    #[Route('/pais/{codigoPais}', name: 'detallePais', methods:['GET'])]
    public function detallePais(ManagerRegistry $doctrine,$codigoPais): JsonResponse
    {
        $pais = $doctrine->getRepository(Pais::class)->findOneBy(['codigo' => $codigoPais]);

        if (!$pais) {
            throw $this->createNotFoundException(
                'No hay datos'
            );
        }
        
        $result[] = array(
            'nombre' => $pais->getNombre(),
            'capital' => $pais->getCapital(),
            'poblacion' => $pais->getPoblacion(),
            'moneda' => $pais->getMoneda(),
            'idioma' => $pais->getIdioma(),
        );

        // return new JsonResponse(['paises'=>$result]);
        return $this->json(['pais'=>$result]);
    }

    // #[Route('/paises/', name: 'listaPaises', methods:['GET'])]
    // public function lista(): JsonResponse
    // {
        
    //     return $this->json([
    //         'message' => 'Welcome to your new controller! ',
    //         'path' => 'src/Controller/PaisController.php',
    //     ]);
    // }
    #[Route('/paises/', name: 'listaPaises')]
    public function listaPaises(ManagerRegistry $doctrine): JsonResponse
    {
        $paises = $doctrine->getRepository(Pais::class)->findAll();

        if (!$paises) {
            throw $this->createNotFoundException(
                'No hay datos'
            );
        }
        
        $result = array();

        foreach($paises as $pais) {
            $result[] = array(
                'nombre' => $pais->getNombre(),
                'capital' => $pais->getCapital(),
                'poblacion' => $pais->getPoblacion(),
                'moneda' => $pais->getMoneda(),
                'idioma' => $pais->getIdioma(),
            );
        }

        return new JsonResponse(['paises'=>$result]);
    }
}
