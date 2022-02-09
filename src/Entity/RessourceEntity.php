<?php

namespace App\Entity;

use App\Repository\RessourceEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RessourceEntityRepository::class)]
class RessourceEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: DofusRessource::class, inversedBy: 'ressourceEntities')]
    #[ORM\JoinColumn(nullable: false)]
    private $ressource_id;

    #[ORM\Column(type: 'float')]
    /**
     * * @Assert\NotBlank
     */
    private $price;

    #[ORM\Column(type: 'float')]
    /**
     * * @Assert\NotBlank
     */
    private $coeff_pepite;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'ressourceEntities')]
    #[ORM\JoinColumn(nullable: false)]
    private $user_id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    private float $bonus ;


    public function __construct()
    {

        $time = new \DateTime();
        $this->setDate($time);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRessourceId(): ?DofusRessource
    {
        return $this->ressource_id;
    }

    public function setRessourceId(?DofusRessource $ressource_id): self
    {
        $this->ressource_id = $ressource_id;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCoeffPepite(): ?float
    {
        return $this->coeff_pepite;
    }

    public function setCoeffPepite(float $coeff_pepite): self
    {
        $this->coeff_pepite = $coeff_pepite;

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->user_id;
    }

    public function setUserId(?Users $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * @param mixed $bonus
     */
    public function setBonus($bonus): void
    {
        $this->bonus = $bonus;
    }

    public function setCoeffPepiteByBonus(float $pepite, int $bonus)
    {
        $this->setCoeffPepite($pepite*2 / (1+($bonus/100)));
    }
}
