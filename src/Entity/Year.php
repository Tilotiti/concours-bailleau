<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Year
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\YearRepository")
 */
class Year
{
    /**
     * @var int
     * @ORM\Id()
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
     * @ORM\ManyToOne(targetEntity="Page", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $page;

    /**
     * @var Partner[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Partner", mappedBy="year")
     */
    private $partners;

    /**
     * @var Thank[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Thank", mappedBy="year")
     */
    private $thanks;

    public function __construct()
    {
        $this->id = date('Y');
        $this->contests = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->thanks = new ArrayCollection();
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

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function addContest(Contest $contest): self
    {
        if (!$this->contests->contains($contest)) {
            $this->contests[] = $contest;
            $contest->setYear($this);
        }

        return $this;
    }

    public function removeContest(Contest $contest): self
    {
        if ($this->contests->contains($contest)) {
            $this->contests->removeElement($contest);
            // set the owning side to null (unless already changed)
            if ($contest->getYear() === $this) {
                $contest->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Partner[]|ArrayCollection
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * @param Partner[]|ArrayCollection $partners
     */
    public function setPartners($partners): void
    {
        $this->partners = $partners;
    }

    /**
     * @return Thank[]|ArrayCollection
     */
    public function getThanks()
    {
        return $this->thanks;
    }

    /**
     * @param Thank[]|ArrayCollection $thanks
     */
    public function setThanks($thanks): void
    {
        $this->thanks = $thanks;
    }
}