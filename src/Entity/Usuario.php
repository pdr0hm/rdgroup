<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    
   // private $login;

    /**
     * @ORM\Column(type="string", length=30)
     */
   // private $senha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

   /*
    public function getLogin(): ?string
    {
        return $this->login;   
      }   
    
    public function setLogin($login): self
    {
        $this->login = $login;

        return $this;
    }

    

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }*/
}
