<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: RessourceEntity::class)]
    private $ressourceEntities;

    #[ORM\ManyToOne(targetEntity: Guild::class, inversedBy: 'users')]
    private $guild;

    #[ORM\ManyToMany(targetEntity: Group::class, inversedBy: 'users')]
    private $group�s;


    public function __construct()
    {
        $this->ressourceEntities = new ArrayCollection();
        $this->group�s = new ArrayCollection();


    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $ressourceEntity->setUserId($this);
        }

        return $this;
    }

    public function removeRessourceEntity(RessourceEntity $ressourceEntity): self
    {
        if ($this->ressourceEntities->removeElement($ressourceEntity)) {
            // set the owning side to null (unless already changed)
            if ($ressourceEntity->getUserId() === $this) {
                $ressourceEntity->setUserId(null);
            }
        }

        return $this;
    }

    public function getGuild(): ?Guild
    {
        return $this->guild;
    }

    public function setGuild(?Guild $guild): self
    {
        $this->guild = $guild;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroup�s(): Collection
    {
        return $this->group�s;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->group�s->contains($group)) {
            $this->group�s[] = $group;
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        $this->group�s->removeElement($group);

        return $this;
    }



}
