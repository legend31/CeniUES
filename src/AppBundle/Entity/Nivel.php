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


    /**
     * Get idnivel
     *
     * @return integer
     */
    public function getIdnivel()
    {
        return $this->idnivel;
    }

    /**
     * Set nombrenivel
     *
     * @param string $nombrenivel
     *
     * @return Nivel
     */
    public function setNombrenivel($nombrenivel)
    {
        $this->nombrenivel = $nombrenivel;

        return $this;
    }

    /**
     * Get nombrenivel
     *
     * @return string
     */
    public function getNombrenivel()
    {
        return $this->nombrenivel;
    }

    /**
     * Set duracion
     *
     * @param integer $duracion
     *
     * @return Nivel
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
     * @return Nivel
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
     * @return Nivel
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
     * Add modulomodulo
     *
     * @param \AppBundle\Entity\Modulo $modulomodulo
     *
     * @return Nivel
     */
    public function addModulomodulo(\AppBundle\Entity\Modulo $modulomodulo)
    {
        $this->modulomodulo[] = $modulomodulo;

        return $this;
    }

    /**
     * Remove modulomodulo
     *
     * @param \AppBundle\Entity\Modulo $modulomodulo
     */
    public function removeModulomodulo(\AppBundle\Entity\Modulo $modulomodulo)
    {
        $this->modulomodulo->removeElement($modulomodulo);
    }

    /**
     * Get modulomodulo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModulomodulo()
    {
        return $this->modulomodulo;
    }

    /**
     * Add seccionseccion
     *
     * @param \AppBundle\Entity\Seccion $seccionseccion
     *
     * @return Nivel
     */
    public function addSeccionseccion(\AppBundle\Entity\Seccion $seccionseccion)
    {
        $this->seccionseccion[] = $seccionseccion;

        return $this;
    }

    /**
     * Remove seccionseccion
     *
     * @param \AppBundle\Entity\Seccion $seccionseccion
     */
    public function removeSeccionseccion(\AppBundle\Entity\Seccion $seccionseccion)
    {
        $this->seccionseccion->removeElement($seccionseccion);
    }

    /**
     * Get seccionseccion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeccionseccion()
    {
        return $this->seccionseccion;
    }
}
