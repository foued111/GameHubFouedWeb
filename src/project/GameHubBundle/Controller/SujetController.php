<?php
/**
 * Created by PhpStorm.
 * User: Foued
 * Date: 04/04/2017
 * Time: 00:12
 */

namespace project\GameHubBundle\Controller;


use project\GameHubBundle\Entity\Sujet;
use project\GameHubBundle\Form\SujetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SujetController extends Controller
{

//    public function ajoutSujetAction(Request $request)
//    {
//
//        $sujet = new Sujet();
//        $Form = $this->createForm(SujetType::class, $sujet);
//        $Form->handleRequest($request);
//        if ($Form->isValid()) {
//
//
//            $em = $this->getDoctrine()->getManager();
//            $user=$this->getUser();
//            $sujet->setIdMembre($user);
//            $em->persist($sujet);
//            $em->flush();
//            return $this->redirectToRoute("listSujet");
//        }
//        return $this->render('projectGameHubBundle:Sujet:ajout.html.twig', array(
//            'form' => $Form->createView()
//        ));
//    }
    public function ajout2Action(Request $request)
    {
        $sujet = new Sujet();
        if($request->isMethod('post')){
            $sujet->setTitre($request->get('titre'));
            $sujet->setText(($request->get('text')));
            $sujet->setCategory(($request->get('category')));
            $em = $this->getDoctrine()->getManager();
            $user=$em->getRepository("projectGameHubBundle:Membre")->find($this->getUser()->getId());
            $sujet->setIdMembre($user);
            $em->persist($sujet);
            $em->flush();
            return $this->redirectToRoute("listSujet", array('category'=> $sujet->getCategory() ));


        }
        return $this->render('projectGameHubBundle:Sujet:ajout.html.twig');
//
    }

    public function listSujetAction(Request $request, $category)
    {

        $em=$this->getDoctrine()->getManager();
        $sujet=$em->getRepository("projectGameHubBundle:Sujet")->findBy(array('category'=>$category));

        foreach ($sujet as $s){
            $reponse = $em->getRepository("projectGameHubBundle:Reponse")->findBy(array('idSujet'=>$s));
            $x[$s->getIdSujet()]=sizeof($reponse);
        }

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
          $sujet,
            $request->query->getInt('page', 1),
            1

        );



        return $this->render('projectGameHubBundle:Sujet:affiche.html.twig',array(
            'sujets'=>$pagination,
            'x'=>$x,
            'category'=>$category,


        ));

    }


    public function deleteSujetAction($id){
        $em=$this->getDoctrine()->getManager();
        $sujet=$em->getRepository("projectGameHubBundle:Sujet")->find($id);
        $reponse=$em->getRepository("projectGameHubBundle:Reponse")->findBy(array('idSujet' => $id));

        $category = $sujet->getCategory();
        foreach ($reponse as $r){

            $em->remove($r);

            $em->flush();
        }
        $em->remove($sujet);
        $em->flush();
        return $this->redirectToRoute("listSujet", array('category'=> $category ));

    }
    public function modifierSujetAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $sujet=$em->getRepository("projectGameHubBundle:Sujet")->find($id);
        $Form = $this->createForm(SujetType::class, $sujet);

        $Form->handleRequest($request);


        if($Form->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($sujet);
            $em->flush();
            return $this->redirectToRoute("listSujet", array('category'=> $sujet->getCategory() ));
        }
        return $this->render('projectGameHubBundle:Sujet:modifier.html.twig',array(
            'form' =>$Form->createView(),
            'sujet' =>$sujet
        ));
    }
    public function singleSujetAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $sujet=$em->getRepository("projectGameHubBundle:Sujet")->find($id);

        $reponses=$em->getRepository("projectGameHubBundle:Reponse")->findBy(array('idSujet' => $id));

        return $this->render('projectGameHubBundle:Sujet:singleSujet.html.twig',array(
            'sujet'=>$sujet,
            'reponses'=>$reponses
        ));
    }
    public function categoryAction()
    {
        $em=$this->getDoctrine()->getManager();
//        $sujet=$em->getRepository("projectGameHubBundle:Sujet")->find($id);

       // $reponses=$em->getRepository("projectGameHubBundle:Reponse")->findBy(array('idSujet' => $id));

        return $this->render('projectGameHubBundle:Sujet:category.html.twig',array(
        ));
    }

}