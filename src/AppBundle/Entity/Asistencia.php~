<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia", indexes={@ORM\Index(name="fk_Asistencia_Clase1_idx", columns={"Clase_idClase"}), @ORM\Index(name="fk_Asistencia_AsistenciaDia1_idx", columns={"AsistenciaDia_idAsistenciaDia"})})
 * @ORM\Entity
 */
class Asistencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAsistencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idasistencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=60, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Asistenciadia
     *
     * @ORM\ManyToOne(targetEntity="Asistenciadia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AsistenciaDia_idAsistenciaDia", referencedColumnName="idAsistenciaDia")
     * })
     */
    private $asistenciadiaasistenciadia;

    /**
     * @var \Clase
     *
     * @ORM\ManyToOne(targetEntity="Clase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Clase_idClase", referencedColumnName="idClase")
     * })
     */
    private $claseclase;



    /**
     * Get idasistencia
     *
     * @return integer
     */
    public function getIdasistencia()
    {
        return $this->idasistencia;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Asistencia
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set asistenciadiaasistenciadia
     *
     * @param \AppBundle\Entity\Asistenciadia $asistenciadiaasistenciadia
     *
     * @return Asistencia
     */
    public function setAsistenciadiaasistenciadia(\AppBundle\Entity\Asistenciadia $asistenciadiaasistenciadia = null)
    {
        $this->asistenciadiaasistenciadia = $asistenciadiaasistenciadia;

        return $this;
    }

    /**
     * Get asistenciadiaasistenciadia
     *
     * @return \AppBundle\Entity\Asistenciadia
     */
    public function getAsistenciadiaasistenciadia()
    {
        return $this->asistenciadiaasistenciadia;
    }

    /**
     * Set claseclase
     *
     * @param \AppBundle\Entity\Clase $claseclase
     *
     * @return Asistencia
     */
    public function setClaseclase(\AppBundle\Entity\Clase $claseclase = null)
    {
        $this->claseclase = $claseclase;

        return $this;
    }

    /**
     * Get claseclase
     *
     * @return \AppBundle\Entity\Clase
     */
    public function getClaseclase()
    {
        return $this->claseclase;
    }
}
