<?php

namespace App\Controller;

use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contacto;
use Doctrine\Persistence\ManagerRegistry;


class ContactoController extends AbstractController
{
    private $contactos = [

        1 => ["nombre" => "Bulbasaur", "numero" => "0001", "Tipo" => "planta/veneno"],

        8 => ["nombre" => "Wartortle", "numero" => "0008", "Tipo" => "agua"],

        6 => ["nombre" => "Charizard", "numero" => "0006", "Tipo" => "fuego/volador"],

        23 => ["nombre" => "Ekans", "numero" => "0023", "Tipo" => "veneno"],

        15 => ["nombre" => "Beedril", "numero" => "0015", "Tipo" => "bicho/veneno"]

    ];     

    

    #[Route('/contacto/{codigo}', name: 'ficha_contacto')]
        public function ficha(ManagerRegistry $doctrine, $codigo): Response{
            $resultado = ($this->contactos[$codigo] ?? null);


            return $this->render('ficha_contactos.html.twig', [
                'contacto' => $resultado
            ]);
        }
        #[Route('/contacto/buscar/{texto}', name: 'buscar_contacto')]
        public function buscar(ManagerRegistry $doctrine, $texto): Response{
            $resultados = array_filter($this->contactos,
                function ($contacto) use ($texto){
                    return strpos($contacto["nombre"], $texto) !== FALSE;
                }
            );

            return $this->render('lista_contactos.html.twig', [
                'contactos' => $resultados
            ]);
        }
    }
