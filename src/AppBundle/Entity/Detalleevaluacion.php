<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detalleevaluacion
 *
 * @ORM\Table(name="detalleevaluacion", indexes={@ORM\Index(name="fk_DetalleEvaluacion_Nivel1_idx", columns={"Nivel_idNivel"}), @ORM\Index(name="fk_DetalleEvaluacion_Modulo1_idx", columns={"Modulo_idModulo"}), @ORM\Index(name="fk_DetalleEvaluacion_Docente1_idx", columns={"Docente_carnetDocente"})})
 * @ORM\Entity
 */
class Detalleevaluacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDetalleEvaluacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddetalleevaluacion;

    /**
     * @var \Docente
     *
     * @ORM\ManyToOne(targetEntity="Docente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Docente_carnetDocente", referencedColumnName="carnetDocente")
     * })
     */
    private $docenteCarnetdocente;

    /**
     * @var \Modulo
     *
     * @ORM\ManyToOne(targetEntity="Modulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Modulo_idModulo", referencedColumnName="idModulo")
     * })
     */
    private $modulomodulo;

    /**
     * @var \Nivel
     *
     * @ORM\ManyToOne(targetEntity="Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     * })
     */
    private $nivelnivel;


}

