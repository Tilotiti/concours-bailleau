<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * Class Classe
 * @package App\Entity
 * @ORM\Entity()
 */
class Classe implements TranslatableInterface
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
     * @var Contest
     * @ORM\ManyToOne(targetEntity="Contest", inversedBy="classes")
     */
    private $contest;

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
     * @return Contest
     */
    public function getContest(): Contest
    {
        return $this->contest;
    }

    /**
     * @param Contest $contest
     */
    public function setContest(Contest $contest): void
    {
        $this->contest = $contest;
    }
}