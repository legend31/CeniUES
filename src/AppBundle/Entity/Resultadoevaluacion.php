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


}

