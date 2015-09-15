<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matricula
 *
 * @ORM\Table(name="matricula", indexes={@ORM\Index(name="fk_Matricula_Nivel1_idx", columns={"Nivel_idNivel"})})
 * @ORM\Entity
 */
class Matricula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMatricula", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmatricula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaMatricula", type="date", nullable=false)
     */
    private $fechamatricula;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroRecibo", type="string", length=45, nullable=false)
     */
    private $numerorecibo;

    /**
     * @var integer
     *
     * @ORM\Column(name="esActivo", type="integer", nullable=false)
     */
    private $esactivo;

    /**
     * @var \Nivel
     *
     * @ORM\ManyToOne(targetEntity="Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     * })
     */
    private $nivelnivel;


}

