<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
class BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTime $updateAt;

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private ?bool $isActive = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updateAt;
    }

    public function isActivate(): bool
    {
        return $this->isActive;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updateAt = new \DateTime();
        $this->isActive = true;
    }

    #[ORM\PreUpdate]
    public function setUpdatedValue(): void
    {
        $this->updateAt = new \DateTime();
    }

    public function activate(): static
    {
        $this->isActive = true;
        $this->updateAt = new \DateTime();
        return $this;
    }

    public function deactivate(): static
    {
        $this->isActive = false;
        $this->updateAt = new \DateTime();
        return $this;
    }


}
