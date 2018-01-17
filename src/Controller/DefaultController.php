<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Lbc;

class DefaultController extends Controller{
    
    /**
     * @Route("/")
     */
    public function index(Request $request){
        
        $formLbc = null;
        $form = $this->createFormBuilder()
                ->add("url", TextType::class, array(
                    'label' => "Url"
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Afficher'
                ))
                ->getForm();
        
        $form->handleRequest($request);
        $lbc = null;
        
        if ($form->isSubmitted() && $form->isValid()) {
            $url = $form->get('url')->getData();
            $lbc = (new Lbc\GetFrom)->search($url);
            
            $formLbc = $this->createFormBuilder()
                    ->setAction($this->generateUrl("app_default_crawler"))
                    ->add('url', HiddenType::class, array(
                        'data' => $url
                    ))
                    ->add('save', SubmitType::class, array(
                        'label' => "Récupérer"
                    ))
                    ->getForm()
                    ->createView();
        }
        
        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
            'lbc' => $lbc,
            'formLbc' => $formLbc
        ));
    }
    
    /**
     * @Route("/crawler")
     * @Method({"POST"})
     */
    public function crawler(Request $request){
        $url = $request->request->get('form')['url'];
        
        $lbc = (new Lbc\GetFrom)->search($url);
        
    }
    
}
