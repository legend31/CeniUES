<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistenciadia
 *
 * @ORM\Table(name="asistenciadia", indexes={@ORM\Index(name="fk_AsistenciaDia_AsistenciaAlumno1_idx", columns={"AsistenciaAlumno_idAsistenciaAlumno"})})
 * @ORM\Entity
 */
class Asistenciadia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAsistenciaDia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idasistenciadia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \Asistenciaalumno
     *
     * @ORM\ManyToOne(targetEntity="Asistenciaalumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="AsistenciaAlumno_idAsistenciaAlumno", referencedColumnName="idAsistenciaAlumno")
     * })
     */
    private $asistenciaalumnoasistenciaalumno;



    /**
     * Get idasistenciadia
     *
     * @return integer
     */
    public function getIdasistenciadia()
    {
        return $this->idasistenciadia;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Asistenciadia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set asistenciaalumnoasistenciaalumno
     *
     * @param \AppBundle\Entity\Asistenciaalumno $asistenciaalumnoasistenciaalumno
     *
     * @return Asistenciadia
     */
    public function setAsistenciaalumnoasistenciaalumno(\AppBundle\Entity\Asistenciaalumno $asistenciaalumnoasistenciaalumno = null)
    {
        $this->asistenciaalumnoasistenciaalumno = $asistenciaalumnoasistenciaalumno;

        return $this;
    }

    /**
     * Get asistenciaalumnoasistenciaalumno
     *
     * @return \AppBundle\Entity\Asistenciaalumno
     */
    public function getAsistenciaalumnoasistenciaalumno()
    {
        return $this->asistenciaalumnoasistenciaalumno;
    }
}
