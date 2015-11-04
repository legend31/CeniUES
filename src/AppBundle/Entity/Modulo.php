<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modulo
 *
 * @ORM\Table(name="modulo")
 * @ORM\Entity
 */
class Modulo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idModulo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreModulo", type="string", length=45, nullable=false)
     */
    private $nombremodulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="duracion", type="integer", nullable=true)
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date", nullable=true)
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
     * @ORM\ManyToMany(targetEntity="Nivel", inversedBy="modulomodulo")
     * @ORM\JoinTable(name="modulo_has_nivel",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Modulo_idModulo", referencedColumnName="idModulo")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     *   }
     * )
     */
    private $nivelnivel;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->nivelnivel = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idmodulo
     *
     * @return integer
     */
    public function getIdmodulo()
    {
        return $this->idmodulo;
    }

    /**
     * Set nombremodulo
     *
     * @param string $nombremodulo
     *
     * @return Modulo
     */
    public function setNombremodulo($nombremodulo)
    {
        $this->nombremodulo = $nombremodulo;

        return $this;
    }

    /**
     * Get nombremodulo
     *
     * @return string
     */
    public function getNombremodulo()
    {
        return $this->nombremodulo;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     *
     * @return Modulo
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return integer
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     *
     * @return Modulo
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafin
     *
     * @param \DateTime $fechafin
     *
     * @return Modulo
     */
    public function setFechafin($fechafin)
    {
        $this->fechafin = $fechafin;

        return $this;
    }

    /**
     * Get fechafin
     *
     * @return \DateTime
     */
    public function getFechafin()
    {
        return $this->fechafin;
    }

    /**
     * Add nivelnivel
     *
     * @param \AppBundle\Entity\Nivel $nivelnivel
     *
     * @return Modulo
     */
    public function addNivelnivel(\AppBundle\Entity\Nivel $nivelnivel)
    {
        $this->nivelnivel[] = $nivelnivel;

        return $this;
    }

    /**
     * Remove nivelnivel
     *
     * @param \AppBundle\Entity\Nivel $nivelnivel
     */
    public function removeNivelnivel(\AppBundle\Entity\Nivel $nivelnivel)
    {
        $this->nivelnivel->removeElement($nivelnivel);
    }

    /**
     * Get nivelnivel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNivelnivel()
    {
        return $this->nivelnivel;
    }
}
