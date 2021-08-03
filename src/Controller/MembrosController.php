<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Grupo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/membros")
*/
class MembrosController extends AbstractController
{    
    /** 
     * @Route("/{idGrupo}", name="membros_index")
    */        
    public function indexMembros($idGrupo) : Response
    {                 
        $grupo = $this->getDoctrine()->getRepository(Grupo::class)->find($idGrupo);        
        
        return $this->render('grupos/membros.html.twig', [
            'grupo' => $grupo
        ]); 

        //o {idGrupo} depois da rota /membros é o que se chama de slug, que é uma variavel que o metodo get recebe
    } 

    /** 
     * @Route("/inscricao/{idGrupo}", methods={"POST"}, name="inscricao")
    */    
    public function addMember(Grupo $idGrupo): Response
    {                        
        $idUsuario = $this->getUser()->getId();                            
              
        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($idUsuario); //pego usuário "fixo" com o ID"        
        $grupo = $this->getDoctrine()->getRepository(Grupo::class)->find($idGrupo); 

        if (!$usuario || !$grupo) {
            new Response("Grupo ou usuário não encontrado"); //garantido com que nem usuario nem grupo venha nulo
        }  
        
        $grupo->addMembro($usuario); //acessando o metodo da classe e passando como parametro o usuario buscado

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($grupo); //persistencia na memoria
        $entityManager->flush();//envia p db

        return new Response ("Usuário inscrito no grupo");
    }
}           

        
