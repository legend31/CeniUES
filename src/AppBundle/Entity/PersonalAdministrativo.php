<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonalAdministrativo
 *
 * @ORM\Table(name="personal_administrativo")
 * @ORM\Entity
 */
class PersonalAdministrativo
{
    /**
     * @var string
     *
     * @ORM\Column(name="carnet", type="string", length=7, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $carnet;

    /**
     * @var string
     *
     * @ORM\Column(name="primerNombre", type="string", length=45, nullable=false)
     */
    private $primernombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoNombre", type="string", length=45, nullable=true)
     */
    private $segundonombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellido", type="string", length=45, nullable=false)
     */
    private $primerapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellido", type="string", length=45, nullable=true)
     */
    private $segundoapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="dui", type="string", length=11, nullable=false)
     */
    private $dui;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="date", nullable=true)
     */
    private $fechanacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=60, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=8, nullable=true)
     */
    private $telefono;


}

