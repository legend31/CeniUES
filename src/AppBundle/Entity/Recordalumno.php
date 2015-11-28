<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recordalumno
 *
 * @ORM\Table(name="recordalumno", indexes={@ORM\Index(name="fk_RecordAlumno_Alumno1_idx", columns={"Alumno_carnetAlumno"})})
 * @ORM\Entity
 */
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RecordAlumnoRepository")
 */
class Recordalumno
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRecordAlumno", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecordalumno;

    /**
     * @var float
     *
     * @ORM\Column(name="notaFinal", type="float", precision=10, scale=0, nullable=false)
     */
    private $notafinal;

    /**
     * @var \Alumno
     *
     * @ORM\ManyToOne(targetEntity="Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Alumno_carnetAlumno", referencedColumnName="carnetAlumno")
     * })
     */
    private $alumnoCarnetalumno;



    /**
     * Get idrecordalumno
     *
     * @return integer
     */
    public function getIdrecordalumno()
    {
        return $this->idrecordalumno;
    }

    /**
     * Set notafinal
     *
     * @param float $notafinal
     *
     * @return Recordalumno
     */
    public function setNotafinal($notafinal)
    {
        $this->notafinal = $notafinal;

        return $this;
    }

    /**
     * Get notafinal
     *
     * @return float
     */
    public function getNotafinal()
    {
        return $this->notafinal;
    }

    /**
     * Set alumnoCarnetalumno
     *
     * @param \AppBundle\Entity\Alumno $alumnoCarnetalumno
     *
     * @return Recordalumno
     */
    public function setAlumnoCarnetalumno(\AppBundle\Entity\Alumno $alumnoCarnetalumno = null)
    {
        $this->alumnoCarnetalumno = $alumnoCarnetalumno;

        return $this;
    }

    /**
     * Get alumnoCarnetalumno
     *
     * @return \AppBundle\Entity\Alumno
     */
    public function getAlumnoCarnetalumno()
    {
        return $this->alumnoCarnetalumno;
    }
}
