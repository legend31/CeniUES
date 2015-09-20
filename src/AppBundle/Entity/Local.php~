<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Local
 *
 * @ORM\Table(name="local")
 * @ORM\Entity
 */
class Local
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLocal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlocal;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreLocal", type="string", length=70, nullable=false)
     */
    private $nombrelocal;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreFacultad", type="string", length=70, nullable=true)
     */
    private $nombrefacultad;



    /**
     * Get idlocal
     *
     * @return integer
     */
    public function getIdlocal()
    {
        return $this->idlocal;
    }

    /**
     * Set nombrelocal
     *
     * @param string $nombrelocal
     *
     * @return Local
     */
    public function setNombrelocal($nombrelocal)
    {
        $this->nombrelocal = $nombrelocal;

        return $this;
    }

    /**
     * Get nombrelocal
     *
     * @return string
     */
    public function getNombrelocal()
    {
        return $this->nombrelocal;
    }

    /**
     * Set nombrefacultad
     *
     * @param string $nombrefacultad
     *
     * @return Local
     */
    public function setNombrefacultad($nombrefacultad)
    {
        $this->nombrefacultad = $nombrefacultad;

        return $this;
    }

    /**
     * Get nombrefacultad
     *
     * @return string
     */
    public function getNombrefacultad()
    {
        return $this->nombrefacultad;
    }
}
