<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;




#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Habitat $habitat = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?RegimeAlimentaire $regime = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Commentaire::class)]
    private Collection $commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFile;

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile): void
    {
        $this->imageFIle = $imageFile;
    }

    /**
     * @param int|null $id
     * @param string|null $nom
     * @param string|null $description
     * @param string|null $image
     * @param \DateTimeInterface|null $date_creation
     * @param Habitat|null $habitat
     * @param RegimeAlimentaire|null $regime
     * @param Categorie|null $categorie
     * @param Collection $commentaire
     */
    public function __construct(?string $nom=null, ?string $description=null, ?string $image=null, ?Habitat $habitat=null, ?RegimeAlimentaire $regime=null, ?Categorie $categorie=null)
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->image = $image;
        $this->date_creation = new \DateTime();
        $this->habitat = $habitat;
        $this->regime = $regime;
        $this->categorie = $categorie;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): self
    {
        $this->habitat = $habitat;

        return $this;
    }

    public function getRegime(): ?RegimeAlimentaire
    {
        return $this->regime;
    }

    public function setRegime(?RegimeAlimentaire $regime): self
    {
        $this->regime = $regime;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire->add($commentaire);
            $commentaire->setAnimal($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getAnimal() === $this) {
                $commentaire->setAnimal(null);
            }
        }

        return $this;
    }
}
