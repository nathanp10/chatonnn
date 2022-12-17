<?php

namespace App\Entity;

use App\Repository\ProprietairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProprietairesRepository::class)
 */
class Proprietaires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $chat;

    /**
     * @ORM\ManyToMany(targetEntity=Chaton::class, mappedBy="proprietaires")
     */
    private $Proprietaires;

    public function __construct()
    {
        $this->Proprietaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getChat(): ?string
    {
        return $this->chat;
    }

    public function setChat(?string $chat): self
    {
        $this->chat = $chat;

        return $this;
    }

    /**
     * @return Collection<int, Chaton>
     */
    public function getProprietaires(): Collection
    {
        return $this->Proprietaires;
    }

    public function addProprietaire(Chaton $proprietaire): self
    {
        if (!$this->Proprietaires->contains($proprietaire)) {
            $this->Proprietaires[] = $proprietaire;
            $proprietaire->addProprietaire($this);
        }

        return $this;
    }

    public function removeProprietaire(Chaton $proprietaire): self
    {
        if ($this->Proprietaires->removeElement($proprietaire)) {
            $proprietaire->removeProprietaire($this);
        }

        return $this;
    }
}
