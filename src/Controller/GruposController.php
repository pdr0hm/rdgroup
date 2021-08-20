<?php

namespace App\Controller;

use App\Entity\Grupo;
use App\Entity\Usuario;
use App\Form\NewGroupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/grupos")
 */

class GruposController extends AbstractController
{
    /** 
     * @Route("/", name="home")
    */
    public function indexGrupos(Request $request) : Response
    {   
        $form = $this->createFormBuilder(null)
            ->add('busca', TextType::class,[
              'attr' => [
              'placeholder' => 'Busque aqui uma Rede Docente', 
              'class' => 'form-searchbar'
            ], 
            'label' => false , 'required' => false])
            ->add('search', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-search'                
                ]                
            ])
            ->getForm(); 
        $form->handleRequest($request); 
        
        
                                                               
        if($form->isSubmitted() && $form->isValid()){
                                
            $nomeGrupo = $form->getData();                      
            $grupos = $this->getDoctrine()
                ->getRepository(Grupo::class)
                ->findByName($nomeGrupo["busca"]); 
             
            return $this->render('grupos/index.html.twig', [
                'grupos' => $grupos, 
                'form' => $form->createView()
            ]);
        }     
                  
        $grupos = $this->getDoctrine()
            ->getRepository(Grupo::class)
            ->findBy([
                'visibilidade' => true
            ]);  

        return $this->render('grupos/index.html.twig', [
            'grupos' => $grupos,
            'form' => $form->createView()
        ]);     
    }   
        
    /** 
     * @Route("/criargrupo", methods={"GET", "POST"}, name="criargrupo")
    */
    public function newGroup(Request $request, SluggerInterface $slugger)
    {       
        $grupo= new Grupo();        

        $form = $this->createForm(NewGroupType::class, $grupo);   
              
        $form->handleRequest($request);            
        

        if($form->isSubmitted() && $form->isValid()){

                    
            /** @var UploadedFile $fotoCapa */
            $fotoCapa = $form->get('fotoCapa')->getData();

            if($fotoCapa) {
                $originalNomeFoto = pathinfo($fotoCapa->getClientOriginalName(), PATHINFO_FILENAME);
                $safeNomeFoto = $slugger->slug($originalNomeFoto);
                $novoNomeFoto = $safeNomeFoto.'-'.uniqid().'.'.$fotoCapa->guessExtension();

                try {
                    $fotoCapa->move(
                        $this->getParameter('dir_fotos'),
                        $novoNomeFoto
                    );                                    
                 } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                 }
              
                $grupo->setFotoCapa($novoNomeFoto);
            }        
            
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grupo);
            $entityManager->flush();   

            return $this->redirectToRoute('home');         
        }      

        return $this->render('grupos/novogrupo.html.twig',[
            'form' => $form->createView()
        ]);  
     
    }          
}