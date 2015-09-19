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


}

