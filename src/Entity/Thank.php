<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * Class Thank
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ThankRepository")
 */
class Thank implements TranslatableInterface
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
     */
    private $year;

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

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
}