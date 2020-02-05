<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Year
 * @package App\Entity
 * @ORM\Entity()
 */
class Year
{
    /**
     * @var int
     * @ORM\Id()
     * @Assert\Unique()
     * @ORM\Column(type="integer", unique=true)
     * @Assert\GreaterThanOrEqual(2020)
     */
    private $id;

    /**
     * @var Contest[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Contest", mappedBy="year")
     */
    private $contests;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $public;

    /**
     * @var Page|null
     * @ORM\ManyToOne(targetEntity="Page")
     * @ORM\JoinColumn(nullable=true)
     */
    private $page;

    public function __construct()
    {
        $this->contests = new ArrayCollection();
        $this->public = false;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Contest[]|ArrayCollection
     */
    public function getContests()
    {
        return $this->contests;
    }

    /**
     * @param Contest[]|ArrayCollection $contests
     */
    public function setContests($contests): void
    {
        $this->contests = $contests;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     */
    public function setPublic(bool $public): void
    {
        $this->public = $public;
    }

    /**
     * @return Page|null
     */
    public function getPage(): ?Page
    {
        return $this->page;
    }

    /**
     * @param Page|null $page
     */
    public function setPage(?Page $page): void
    {
        $this->page = $page;
    }
}