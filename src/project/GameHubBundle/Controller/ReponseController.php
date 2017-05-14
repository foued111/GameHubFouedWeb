<?php
/**
 * Created by PhpStorm.
 * User: Foued
 * Date: 04/04/2017
 * Time: 15:20
 */

namespace project\GameHubBundle\Controller;


use project\GameHubBundle\Entity\Reponse;
use project\GameHubBundle\Form\ReponseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReponseController extends Controller
{
    public function ajoutReponseAction(Request $request,$id)
    {

        $reponse = new Reponse();
        $em=$this->getDoctrine()->getManager();
        $sujet=$em->getRepository("projectGameHubBundle:Sujet")->find($id);

        if($request->isMethod('post')){

            $reponse->setText($request->get('quickReponse'));
            $reponse->setIdMembrereponse($this->getUser());
            $reponse->setIdSujet($sujet);
            $em = $this->getDoctrine()->getManager();
            $em->persist($reponse);
            $em->flush();

            return $this->redirectToRoute("singleSujet", array('id'=> $id));

        }
        return $this->render('projectGameHubBundle:Reponse:add.html.twig');
    }
    public function listReponseAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $reponse=$em->getRepository("projectGameHubBundle:Reponse")->findBy(array('idSujet'=>$id));
        return $this->render('projectGameHubBundle:Reponse:show.html.twig',array('reponses'=>$reponse,'id'=>$id));
    }
    public function supprimerReponseAction($id){
        $em=$this->getDoctrine()->getManager();
        $reponse=$em->getRepository("projectGameHubBundle:Reponse")->find($id);
        $idreponse = $reponse->getIdSujet()->getIdSujet();

        $em->remove($reponse);
        $em->flush();
       return $this->redirectToRoute("singleSujet", array('id'=> $idreponse ));

    }
    public function updateReponseAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $reponse=$em->getRepository("projectGameHubBundle:Reponse")->find($id);
        $idreponse = $reponse->getIdSujet()->getIdSujet();



        if($request->isMethod('post')){

            $reponse->setText($request->get('text'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute("singleSujet", array('id'=> $idreponse ));
        }
        return $this->render('projectGameHubBundle:Reponse:update.html.twig',array(
            'reponse' =>$reponse
        ));
    }
    public function rechReponseAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();

        if($request->isMethod('POST')&&(($request->get('id'))!=null)){

            $reponse=$em->getRepository("projectGameHubBundle:Reponse")->findBy(array('idSujet'=>$request->get('idSujet')));
            return $this->render('projectGameHubBundle:Sujet:affiche.html.twig',array('Reponses'=>$reponse));
        }

        $reponse=$em->getRepository("projectGameHubBundle:Reponse")->findAll();


        return $this->render('projectGameHubBundle:Sujet:affiche.html.twig',array('reponses'=>$reponse));



    }
    public function NBReponseDQL2Action($sujet)
    {
        $rep=$this->getDoctrine()->getManager()->getRepository('projectGameHubBundle:Reponse');

        $reponse = $rep->findPaysDQL($sujet);

        return $this->render("projectGameHubBundle:Sujet:affiche.html.twig",array('reponses'=>$reponse));
    }
    public function jaimeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $reponse=$em->getRepository('projectGameHubBundle:Reponse')->find($id);

        $reponse->setJaime($reponse->getJaime()+1);
        $sujet=$em->getRepository('projectGameHubBundle:Sujet')->find($reponse->getIdSujet());
        $em->persist($reponse);
        $em->flush($reponse);

        return $this->redirectToRoute("singleSujet", array('id'=>$sujet->getIdSujet()
             ));
    }

    public function jaimepasAction($id )
    {
        $em=$this->getDoctrine()->getManager();
        $reponse=$em->getRepository('projectGameHubBundle:Reponse')->find($id);
        $reponse->setJaimepas($reponse->getJaimepas()+1);
        $sujet=$em->getRepository('projectGameHubBundle:Sujet')->find($reponse->getIdSujet());
        $em->persist($reponse);
        $em->flush($reponse);
        return $this->redirectToRoute("singleSujet", array('id'=> $sujet->getIdSujet() ));
    }
}