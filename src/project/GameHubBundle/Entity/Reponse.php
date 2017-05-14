<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="id_sujet", columns={"id_sujet"}), @ORM\Index(name="id_membre", columns={"id_membrereponse"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reponse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReponse;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=500, nullable=false)
     */
    private $text;

    /**
     * @var \Sujet
     *
     * @ORM\ManyToOne(targetEntity="Sujet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sujet", referencedColumnName="id_sujet")
     * })
     */
    private $idSujet;

    /**
     * @var \Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_membrereponse", referencedColumnName="id_membre")
     * })
     */
    private $idMembrereponse;
    /**
     * @var integer
     *
     * @ORM\Column(name="jaime", type="integer", nullable=true)

     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jaime;
    /**
     * @var integer
     *
     * @ORM\Column(name="jaimepas", type="integer", nullable=true)

     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jaimepas;

    /**
     * @return int
     */
    public function getIdReponse()
    {
        return $this->idReponse;
    }

    /**
     * @param int $idReponse
     */
    public function setIdReponse($idReponse)
    {
        $this->idReponse = $idReponse;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return \Sujet
     */
    public function getIdSujet()
    {
        return $this->idSujet;
    }

    /**
     * @param \Sujet $idSujet
     */
    public function setIdSujet($idSujet)
    {
        $this->idSujet = $idSujet;
    }

    /**
     * @return \Membre
     */
    public function getIdMembrereponse()
    {
        return $this->idMembrereponse;
    }

    /**
     * @param \Membre $idMembrereponse
     */
    public function setIdMembrereponse($idMembrereponse)
    {
        $this->idMembrereponse = $idMembrereponse;
    }

    /**
     * @return int
     */
    public function getJaime()
    {
        return $this->jaime;
    }

    /**
     * @param int $jaime
     */
    public function setJaime($jaime)
    {
        $this->jaime = $jaime;
    }

    /**
     * @return int
     */
    public function getJaimepas()
    {
        return $this->jaimepas;
    }

    /**
     * @param int $jaimepas
     */
    public function setJaimepas($jaimepas)
    {
        $this->jaimepas = $jaimepas;
    }





}

