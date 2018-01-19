<?php

namespace App\Controller;

use Lbc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ad;

class DefaultController extends Controller{
    
    /**
     * @Route("/")
     */
    public function index(Request $request){
                
        $formLbc = null;
        $form = $this->createFormBuilder()
                ->setMethod("GET")
                ->add("url", TextType::class, array(
                    'label' => "Url",
                    'data' => $request->query->get('form')['url']
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Afficher'
                ))
                ->getForm();
        
        $form->handleRequest($request);
        $lbc = null;
        
        if ($form->isSubmitted() && $form->isValid()) {
            $url = $request->query->get('form')['url'];
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
        $em = $this->getDoctrine()->getManager();
        
        for($page = 1; $page <= $lbc['total_page']; $page++){
            $lbc = (new Lbc\GetFrom)->search($url);
            foreach ($lbc['ads'] as $adLbc){
                
                //Sur chaque annonce, on recupère le détail
                $detail = (new Lbc\GetFrom)->ad($adLbc, $lbc['category']);
                $ad = $this->denormalize($detail);
                $ad->setUrl($this->getParameter("url_lbc").$lbc['category']."/".$ad->getId().".htm");
                
                $metadata = $em->getClassMetadata(Ad::class);
                $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
                $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                
                //$em->persist($ad);
                $em->merge($ad);
            }
            
            //On passe au suivant
            $url = $lbc['links']['next'];
        }
        try{
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', "Les annonces ont été enregistré");
        } catch (\Exception $ex) {
            $this->get('session')->getFlashBag()->add('error', "Erreur : ".$ex->getMessage());
        }
        
        return $this->redirect($this->generateUrl("app_default_index", array('form[url]'=>$request->request->get('form')['url'])));
    }
    
    private function denormalize(array $array){
        $ad = new Ad();
        $ad->setId($array['id']);
        $ad->setCategory($array['category']);
        $ad->setImagesThumbs($array['images_thumbs']);
        $ad->setImages($array['images']);
        $ad->setTitre($array['properties']['titre']);
        $ad->setCreatedAt(new \DateTime($array['properties']['created_at']));
        $ad->setIsPro($array['properties']['is_pro'] == 1 ? true : false);
        $ad->setPrix($array['properties']['prix']);
        $ad->setVille($array['properties']['ville']);
        $ad->setCp($array['properties']['cp']);
        $ad->setHonoraires(isset($array['properties']['honoraires']) ? true : false);
        $ad->setTypeDeBien($array['properties']['type_de_bien']);
        $ad->setPieces(isset($array['properties']['pieces']) ? $array['properties']['pieces'] : null);
        $ad->setSurface(isset($array['properties']['surface']) ? $array['properties']['surface'] : null);
        $ad->setReference(isset($array['properties']['reference']) ? $array['properties']['reference'] : null);
        $ad->setGes($array['properties']['ges']);
        $ad->setClasseEnergie($array['properties']['classe_energie']);
        $ad->setDescription($array['description']);
        
        return $ad;
    }
    
}
