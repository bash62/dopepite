<?php

namespace App\Entity;

use App\Repository\DofusRessourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DofusRessourceRepository::class)]
class DofusRessource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $ankamaId;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $level;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'string', length: 255)]
    private $imgUrl;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\OneToMany(mappedBy: 'ressource_id', targetEntity: RessourceEntity::class)]
    private $ressourceEntities;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $available;

    public function __construct()
    {
        $this->ressourceEntities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnkamaId(): ?int
    {
        return $this->ankamaId;
    }

    public function setAnkamaId(int $ankamaId): self
    {
        $this->ankamaId = $ankamaId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    /**
     * @return Collection|RessourceEntity[]
     */
    public function getRessourceEntities(): Collection
    {
        return $this->ressourceEntities;
    }

    public function addRessourceEntity(RessourceEntity $ressourceEntity): self
    {
        if (!$this->ressourceEntities->contains($ressourceEntity)) {
            $this->ressourceEntities[] = $ressourceEntity;
            $ressourceEntity->setRessourceId($this);
        }

        return $this;
    }

    public function removeRessourceEntity(RessourceEntity $ressourceEntity): self
    {
        if ($this->ressourceEntities->removeElement($ressourceEntity)) {
            // set the owning side to null (unless already changed)
            if ($ressourceEntity->getRessourceId() === $this) {
                $ressourceEntity->setRessourceId(null);
            }
        }

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(?bool $available): self
    {
        $this->available = $available;

        return $this;
    }


}
