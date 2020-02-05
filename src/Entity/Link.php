<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * Class Link
 * @package App\Entity
 * @ORM\Entity()
 */
class Link implements TranslatableInterface
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
     * @var Year|null
     * @ORM\ManyToOne(targetEntity="Year")
     *
     */
    private $year;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $index;

    public function __construct()
    {
        $this->index = 0;
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
     * @return Year|null
     */
    public function getYear(): ?Year
    {
        return $this->year;
    }

    /**
     * @param Year|null $year
     */
    public function setYear(?Year $year): void
    {
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index): void
    {
        $this->index = $index;
    }
}