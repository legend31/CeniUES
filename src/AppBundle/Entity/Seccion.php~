<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seccion
 *
 * @ORM\Table(name="seccion")
 * @ORM\Entity
 */
class Seccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSeccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreSeccion", type="string", length=1, nullable=false)
     */
    private $nombreseccion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Nivel", mappedBy="seccionseccion")
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
     * Get idseccion
     *
     * @return integer
     */
    public function getIdseccion()
    {
        return $this->idseccion;
    }

    /**
     * Set nombreseccion
     *
     * @param string $nombreseccion
     *
     * @return Seccion
     */
    public function setNombreseccion($nombreseccion)
    {
        $this->nombreseccion = $nombreseccion;

        return $this;
    }

    /**
     * Get nombreseccion
     *
     * @return string
     */
    public function getNombreseccion()
    {
        return $this->nombreseccion;
    }

    /**
     * Add nivelnivel
     *
     * @param \AppBundle\Entity\Nivel $nivelnivel
     *
     * @return Seccion
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
