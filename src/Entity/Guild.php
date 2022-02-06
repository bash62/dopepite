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

    #[ORM\OneToMany(mappedBy: 'guild_id', targetEntity: User::class)]
    private $users;

    #[ORM\OneToMany(mappedBy: 'guild_id', targetEntity: Areas::class)]
    private $areas;

    #[ORM\OneToMany(mappedBy: 'guild', targetEntity: Users::class)]
    private $group_id;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->areas = new ArrayCollection();
        $this->group_id = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGuildId($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getGuildId() === $this) {
                $user->setGuildId(null);
            }
        }

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
    public function getGroupId(): Collection
    {
        return $this->group_id;
    }

    public function addGroupId(Users $groupId): self
    {
        if (!$this->group_id->contains($groupId)) {
            $this->group_id[] = $groupId;
            $groupId->setGuild($this);
        }

        return $this;
    }

    public function removeGroupId(Users $groupId): self
    {
        if ($this->group_id->removeElement($groupId)) {
            // set the owning side to null (unless already changed)
            if ($groupId->getGuild() === $this) {
                $groupId->setGuild(null);
            }
        }

        return $this;
    }
}
