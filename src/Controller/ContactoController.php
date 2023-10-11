<?php

namespace App\Controller;

use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    private $contactos = [

        1 => ["nombre" => "Bulbasaur", "numero" => "0001", "Tipo" => "planta/veneno"],

        8 => ["nombre" => "Wartortle López", "numero" => "0008", "Tipo" => "agua"],

        6 => ["nombre" => "Charizard", "numero" => "0006", "Tipo" => "fuego/volador"],

        23 => ["nombre" => "Ekans", "numero" => "0023", "Tipo" => "veneno"],

        9 => ["nombre" => "Nora Jover", "numero" => "54565859", "Tipo" => "norajover@ieselcaminas.org"]

    ];     

    #[Route('/contacto/{codigo}', name: 'ficha_contacto')]
        public function ficha($codigo): Response{
            $resultado = ($this->contactos[$codigo] ?? null);

            return $this->render('ficha_contacto.html.twig', [
                'contacto' => $resultado
            ]);
        }
        #[Route('/contacto/buscar/{texto}', name: 'buscar_contacto')]
        public function buscar($texto): Response{
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
