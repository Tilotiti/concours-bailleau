<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ClasseTranslation
 * @package App\Entity
 */
class ClasseTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $title;
}