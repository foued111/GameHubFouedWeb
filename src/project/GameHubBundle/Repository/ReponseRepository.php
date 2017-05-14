<?php

/**
 * Created by PhpStorm.
 * User: Foued
 * Date: 05/04/2017
 * Time: 17:01
 */
class ReponseRepository extends \Doctrine\ORM\EntityRepository
{
    public function findReponseDQL($sujet)
    {
        $query=$this->getEntityManager()->createQuery("Select COUNT(*) from projectGameHubBundle:Reponse WHERE id_sujet=:idSujet")->setParameter('sujets',$sujet);
        return $query->getResult();

    }
}
