<?php

namespace App\Entity;

use App\Repository\GuildRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuildRepository::class)]
class Guild
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Servers::class, inversedBy: 'guilds')]
    #[ORM\JoinColumn(nullable: false)]
    private $server_id;



    #[ORM\OneToMany(mappedBy: 'guild_id', targetEntity: Areas::class)]
    private $areas;

    #[ORM\OneToMany(mappedBy: 'guild', targetEntity: Users::class)]
    private $users;


    public function __construct()
    {

        $this->areas = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getServerId(): ?Servers
    {
        return $this->server_id;
    }

    public function setServerId(?Servers $server_id): self
    {
        $this->server_id = $server_id;

        return $this;
    }


    /**
     * @return Collection|Areas[]
     */
    public function getAreas(): Collection
    {
        return $this->areas;
    }

    public function addArea(Areas $area): self
    {
        if (!$this->areas->contains($area)) {
            $this->areas[] = $area;
            $area->setGuildId($this);
        }

        return $this;
    }

    public function removeArea(Areas $area): self
    {
        if ($this->areas->removeElement($area)) {
            // set the owning side to null (unless already changed)
            if ($area->getGuildId() === $this) {
                $area->setGuildId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGuild($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getGuild() === $this) {
                $user->setGuild(null);
            }
        }

        return $this;
    }



}
