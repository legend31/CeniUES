<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluacion
 *
 * @ORM\Table(name="evaluacion")
 * @ORM\Entity
 */
class Evaluacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEvaluacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevaluacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreEvaluacion", type="string", length=45, nullable=true)
     */
    private $nombreevaluacion;

    /**
     * @var float
     *
     * @ORM\Column(name="ponderacion", type="float", precision=10, scale=0, nullable=true)
     */
    private $ponderacion;



    /**
     * Get idevaluacion
     *
     * @return integer
     */
    public function getIdevaluacion()
    {
        return $this->idevaluacion;
    }

    /**
     * Set nombreevaluacion
     *
     * @param string $nombreevaluacion
     *
     * @return Evaluacion
     */
    public function setNombreevaluacion($nombreevaluacion)
    {
        $this->nombreevaluacion = $nombreevaluacion;

        return $this;
    }

    /**
     * Get nombreevaluacion
     *
     * @return string
     */
    public function getNombreevaluacion()
    {
        return $this->nombreevaluacion;
    }

    /**
     * Set ponderacion
     *
     * @param float $ponderacion
     *
     * @return Evaluacion
     */
    public function setPonderacion($ponderacion)
    {
        $this->ponderacion = $ponderacion;

        return $this;
    }

    /**
     * Get ponderacion
     *
     * @return float
     */
    public function getPonderacion()
    {
        return $this->ponderacion;
    }
}
