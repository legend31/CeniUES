<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * TipoUsuario
 *
 * @ORM\Table(name="tipo_usuario")
 * @ORM\Entity
 */
class TipoUsuario implements RoleInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTipo_Usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nomTipoUsuario", type="string", length=45, nullable=false)
     */
    private $nomtipousuario;

    public function getRole()
    {
        return 'ROLE_'.$this->nomtipousuario.'';
    }


}

