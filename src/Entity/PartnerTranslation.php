<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

/**
 * Class PartnerTranslation
 * @package App\Entity
 */
class PartnerTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

}