<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;
use Symfony\Component\Validator\Constraints as Assert;

class ThankTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $label;

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }
}