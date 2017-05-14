<?php

namespace project\GameHubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="id_mpro", columns={"id_mpro"}), @ORM\Index(name="pseudo", columns={"pseudo"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var \MembrePro
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="MembrePro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mpro", referencedColumnName="id_mpro")
     * })
     */
    private $idMpro;


}

