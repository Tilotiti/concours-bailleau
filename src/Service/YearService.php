<?php


namespace App\Service;


use App\Entity\Contest;
use App\Entity\Page;
use App\Entity\Year;
use App\Repository\YearRepository;
use Doctrine\Common\Collections\ArrayCollection;

class YearService
{
    /**
     * @var Year|null
     */
    private $year;

    /**
     * YearService constructor.
     * @param YearRepository $yearRepository
     */
    public function __construct(YearRepository $yearRepository)
    {
        $this->year = $yearRepository->findOneBy([
            'public' => true
        ]);
    }

    /**
     * @return Year|null
     */
    public function get(): ?Year
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->year->getId();
    }

    /**
     * @return Contest[]|ArrayCollection
     */
    public function getContests()
    {
        return $this->year->getContests();
    }

    /**
     * @return Page
     */
    public function getPage(): Page {
        return $this->year->getPage();
    }
}