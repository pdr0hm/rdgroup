<?php

namespace App\Controller;

use App\Entity\Grupo;
use App\Entity\Usuario;
use App\Form\NewGroupType;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;



/**
 * @Route("/grupos")
 */

class GruposController extends AbstractController
{
    /** 
     * @Route("/", name="home")
    */
    public function indexGrupos() : Response
    {           
        $grupos = $this->getDoctrine()->getRepository(Grupo::class)->findBy(['visibilidade' => true]);  
        return $this->render('grupos/index.html.twig', ['grupos' => $grupos]);     
    } 
   

    /** 
     * @Route("/novogrupo", name="novogrupo_index")
    */
    public function indexNovogrupo()
    {   
        return $this->render('grupos/novogrupo.html.twig'); 
       
    } 
   
    /** 
     * @Route("/criargrupo", methods={"GET", "POST"}, name="criargrupo")
    */
    public function newGroup(Request $request)
    {
        // por no parametro da function FormBuilderInterface $builder, array $options
        
        
        $grupo= new Grupo();        

        $form = $this->createForm(NewGroupType::class, $grupo);       
         
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $grupo = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grupo);
            $entityManager->flush();            
        }      

        
        
        return $this->render('grupos/novogrupo.html.twig',['form' => $form->createView() ]);

        

        
       


        /*
        $nomeGrupo = $request->request->get('nomeGrupo');
        $apresentacao = $request->request->get('apresentacao');

        $visibilidade = $request->request->get('visibilidade');   
         
        if (!$visibilidade)
        {
            $visibilidade = false;
        }          
        
        $novoGrupo = new Grupo();
        $novoGrupo->setNomeGrupo($nomeGrupo);
        $novoGrupo->setApresentacao($apresentacao);
        $novoGrupo->setVisibilidade($visibilidade);
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($novoGrupo);
        $entityManager->flush();
                  */

        //return $this->redirectToRoute('home');
    }

     
        
}