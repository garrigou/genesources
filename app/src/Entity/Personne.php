<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\OneToMany(mappedBy: 'personne', targetEntity: Evenement::class)]
    private $evenements;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateNaissance;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateDeces;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private $pere;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private $mere;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
    }

    public function __toString()
    {
        $dateNaissanceFormat = ($this->dateNaissance) ? $this->dateNaissance->format('d/m/Y') : '???';
        $dateDecesFormat = ($this->dateDeces) ? $this->dateDeces->format('d/m/Y') : '???';
        return sprintf('%s %s [%s - %s]', $this->prenom, $this->nom, $dateNaissanceFormat, $dateDecesFormat);
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

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setPersonne($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getPersonne() === $this) {
                $evenement->setPersonne(null);
            }
        }

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getPere(): ?self
    {
        return $this->pere;
    }

    public function setPere(?self $pere): self
    {
        $this->pere = $pere;

        return $this;
    }

    public function getMere(): ?self
    {
        return $this->mere;
    }

    public function setMere(?self $mere): self
    {
        $this->mere = $mere;

        return $this;
    }
}
