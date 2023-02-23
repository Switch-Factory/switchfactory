<?php

namespace App\Entity;

use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CouponRepository::class)
 */
class Coupon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $expired;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getExpired(): ?\DateTimeInterface
    {
        return $this->expired;
    }

    public function setExpired(?\DateTimeInterface $expired): self
    {
        $this->expired = $expired;

        return $this;
    }
}
