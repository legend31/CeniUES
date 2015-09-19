<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nivel
 *
 * @ORM\Table(name="nivel")
 * @ORM\Entity
 */
class Nivel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idNivel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnivel;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreNivel", type="string", length=45, nullable=false)
     */
    private $nombrenivel;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer", nullable=true)
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date", nullable=false)
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="date", nullable=true)
     */
    private $fechafin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Modulo", mappedBy="nivelnivel")
     */
    private $modulomodulo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Seccion", inversedBy="nivelnivel")
     * @ORM\JoinTable(name="nivel_has_seccion",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Seccion_idSeccion", referencedColumnName="idSeccion")
     *   }
     * )
     */
    private $seccionseccion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modulomodulo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seccionseccion = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

