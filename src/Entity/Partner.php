<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * Class Partner
 * @package App\Entity
 * @ORM\Entity()
 */
class Partner implements TranslatableInterface
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
     * @ORM\ManyToOne(targetEntity="Year")
     * @ORM\JoinColumn()
     */
    private $year;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    private $logo;

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
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string|null $logo
     */
    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

}