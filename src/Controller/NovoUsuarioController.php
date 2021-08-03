<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\NewUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class NovoUsuarioController extends AbstractController
{
    /**
     * @Route("/novo-usuario", name="novo_usuario")
     */
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher)
    {
        $usuario = new Usuario();
        $form = $this->createForm(NewUserType::class, $usuario);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $formPassword = $form->getData()->getPassword();
            $setSenha = $userPasswordHasher->hashPassword($usuario, $formPassword);
            $usuario->setPassword($setSenha);

            $entityManager->persist($usuario);
            $entityManager->flush();   

            return $this->redirectToRoute('app_login'); 
        }

        return $this->render('novo_usuario/novousuario.html.twig', [
            'form' => $form->createView()
        ]);            
    }
}

