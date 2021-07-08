<?php

namespace App\Entity;

use App\Repository\GrupoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GrupoRepository::class)
 */
class Grupo
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
    private $nomeGrupo;

    /**
     * @ORM\Column(type="text")
     */
    private $apresentacao;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visibilidade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fotoCapa;

    /**
     * @ORM\ManyToMany(targetEntity=Usuario::class)
     */
    private $membros;

    public function __construct()
    {
        $this->membros = new ArrayCollection();
    }

    public function getId(): ? int
    {
        return $this->id;
    }

    public function getNomeGrupo(): ?string
    {
        return $this->nomeGrupo;
    }

    public function setNomeGrupo(string $nomeGrupo): self
    {
        $this->nomeGrupo = $nomeGrupo;

        return $this;
    }

    public function getApresentacao(): ? string
    {
        return $this->apresentacao;
    }

    public function setApresentacao(string $apresentacao): self
    {
        $this->apresentacao = $apresentacao;

        return $this;
    }

    public function getVisibilidade(): ?bool
    {
        return $this->visibilidade;
    }

    public function setVisibilidade(?bool $visibilidade): self
    {
        $this->visibilidade = $visibilidade;

        return $this;
    }

    public function getFotoCapa(): ?string
    {
        return $this->fotoCapa;
    }

    public function setFotoCapa(?string $fotoCapa): self
    {
        $this->fotoCapa = $fotoCapa;

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getMembros(): Collection
    {
        return $this->membros;
    }

    public function addMembro(Usuario $membro): self
    {
        if (!$this->membros->contains($membro)) {
            $this->membros[] = $membro;
        }

        return $this;
    }

    public function removeMembro(Usuario $membro): self
    {
        $this->membros->removeElement($membro);

        return $this;
    }




}
