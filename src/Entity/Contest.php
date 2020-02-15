<?php


namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * Class Contest
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ContestRepository")
 */
class Contest implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Year
     * @ORM\ManyToOne(targetEntity="Year", inversedBy="contests")
     */
    private $year;

    /**
     * @var Page|null
     * @ORM\ManyToOne(targetEntity="Page", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $page;

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
     * @return Year
     */
    public function getYear(): Year
    {
        return $this->year;
    }

    /**
     * @param Year $year
     */
    public function setYear(Year $year): void
    {
        $this->year = $year;
    }

    /**
     * @return Classe[]|ArrayCollection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param Classe[]|ArrayCollection $classes
     */
    public function setClasses($classes): void
    {
        $this->classes = $classes;
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

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
}