<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

 

#[ORM\Entity(repositoryClass: CampaignRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['campaign:read']],
    denormalizationContext: ['groups' => ['campaign:write']],
)]
class Campaign
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['campaign:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['campaign:read', 'campaign:write'])]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'mastered_campaigns')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['campaign:read', 'campaign:write'])]
    #[MaxDepth(1)]
    private ?User $gamemaster = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'campaigns')]
    #[Groups(['campaign:read', 'campaign:write'])]
    #[MaxDepth(1)]
    private Collection $players;

    #[ORM\Column]
    #[Groups(['campaign:read'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    #[Groups(['campaign:read'])]
    private ?\DateTimeImmutable $updated_at = null;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getGamemaster(): ?User
    {
        return $this->gamemaster;
    }

    public function setGamemaster(?User $gamemaster): static
    {
        $this->gamemaster = $gamemaster;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(User $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
        }

        return $this;
    }

    public function removePlayer(User $player): static
    {
        $this->players->removeElement($player);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
