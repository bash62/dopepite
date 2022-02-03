<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: Ressource::class)]
    private $ressource_id;

    public function __construct()
    {
        $this->ressource_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessourceId(): Collection
    {
        return $this->ressource_id;
    }

    public function addRessourceId(Ressource $ressourceId): self
    {
        if (!$this->ressource_id->contains($ressourceId)) {
            $this->ressource_id[] = $ressourceId;
            $ressourceId->setRecipe($this);
        }

        return $this;
    }

    public function removeRessourceId(Ressource $ressourceId): self
    {
        if ($this->ressource_id->removeElement($ressourceId)) {
            // set the owning side to null (unless already changed)
            if ($ressourceId->getRecipe() === $this) {
                $ressourceId->setRecipe(null);
            }
        }

        return $this;
    }
}
