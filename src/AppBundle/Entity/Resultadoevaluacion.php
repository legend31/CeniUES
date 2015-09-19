<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultadoevaluacion
 *
 * @ORM\Table(name="resultadoevaluacion", indexes={@ORM\Index(name="fk_ResultadoEvaluacion_Evaluacion1_idx", columns={"Evaluacion_idEvaluacion"}), @ORM\Index(name="fk_ResultadoEvaluacion_DetalleEvaluacion1_idx", columns={"DetalleEvaluacion_idDetalleEvaluacion"}), @ORM\Index(name="fk_ResultadoEvaluacion_Alumno1_idx", columns={"Alumno_carnetAlumno"})})
 * @ORM\Entity
 */
class Resultadoevaluacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=true)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="nota", type="float", precision=10, scale=0, nullable=true)
     */
    private $nota;

    /**
     * @var \Alumno
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Alumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Alumno_carnetAlumno", referencedColumnName="carnetAlumno")
     * })
     */
    private $alumnoCarnetalumno;

    /**
     * @var \Detalleevaluacion
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Detalleevaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DetalleEvaluacion_idDetalleEvaluacion", referencedColumnName="idDetalleEvaluacion")
     * })
     */
    private $detalleevaluaciondetalleevaluacion;

    /**
     * @var \Evaluacion
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Evaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Evaluacion_idEvaluacion", referencedColumnName="idEvaluacion")
     * })
     */
    private $evaluacionevaluacion;



    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Resultadoevaluacion
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
     * Set nota
     *
     * @param float $nota
     *
     * @return Resultadoevaluacion
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return float
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set alumnoCarnetalumno
     *
     * @param \AppBundle\Entity\Alumno $alumnoCarnetalumno
     *
     * @return Resultadoevaluacion
     */
    public function setAlumnoCarnetalumno(\AppBundle\Entity\Alumno $alumnoCarnetalumno)
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

    /**
     * Set detalleevaluaciondetalleevaluacion
     *
     * @param \AppBundle\Entity\Detalleevaluacion $detalleevaluaciondetalleevaluacion
     *
     * @return Resultadoevaluacion
     */
    public function setDetalleevaluaciondetalleevaluacion(\AppBundle\Entity\Detalleevaluacion $detalleevaluaciondetalleevaluacion)
    {
        $this->detalleevaluaciondetalleevaluacion = $detalleevaluaciondetalleevaluacion;

        return $this;
    }

    /**
     * Get detalleevaluaciondetalleevaluacion
     *
     * @return \AppBundle\Entity\Detalleevaluacion
     */
    public function getDetalleevaluaciondetalleevaluacion()
    {
        return $this->detalleevaluaciondetalleevaluacion;
    }

    /**
     * Set evaluacionevaluacion
     *
     * @param \AppBundle\Entity\Evaluacion $evaluacionevaluacion
     *
     * @return Resultadoevaluacion
     */
    public function setEvaluacionevaluacion(\AppBundle\Entity\Evaluacion $evaluacionevaluacion)
    {
        $this->evaluacionevaluacion = $evaluacionevaluacion;

        return $this;
    }

    /**
     * Get evaluacionevaluacion
     *
     * @return \AppBundle\Entity\Evaluacion
     */
    public function getEvaluacionevaluacion()
    {
        return $this->evaluacionevaluacion;
    }
}
