<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Usuario;

class LoginController extends AbstractController 
{
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /** 
     * @Route("/", name="indexLogin", methods={"GET"})
    */
    public function indexLogin(Request $request)  
    {                         
        return $this->render('grupos/login.html.twig');     
    }

    /** 
     * @Route ("/login", name="loginUsuario", methods={"POST"})
    */
    public function loginUsuario(Request $request)
    {
        
        $idUsuario = $request->request->get('idUsuario');

        $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($idUsuario);

        if (!$usuario) 
            return $this->redirectToRoute('indexLogin');

        
        $session = $this->requestStack->getSession();
        $session->set('id-usuario', $idUsuario); 
                
        return $this->redirectToRoute('home');
            
    }


    /** 
     * @Route ("/logout", name="logoutUsuario", methods={"GET"})
    */
    public function logoutUsuario(Request $request)
    {        
        $session = $this->requestStack->getSession();     
        $session->set('id-usuario', null);  
        
        return $this->redirectToRoute('indexLogin');
    }

}