<?php


namespace App\Controller;


use App\Entity\Contest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 * @Route("/{_locale}", requirements={"_locale": "en|fr|"}, defaults={"_locale": "fr"})
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("", name="www")
     */
    public function index() {
        return $this->render('www/index.html.twig');
    }

    /**
     * @Route("/sign", name="www_sign")
     */
    public function sign() {
        return $this->render('www/sign.html.twig');
    }

    /**
     * @Route("/contact", name="www_contact")
     */
    public function contact() {
        return $this->render('www/contact.html.twig');
    }

    /**
     * @Route("/partners", name="www_partner")
     */
    public function partner() {
        return $this->render('www/partner.html.twig');
    }

    /**
     * @Route("/contest/{contest}/{slug}", name="www_contest")
     * @param Contest $contest
     * @return Response
     */
    public function contest(Contest $contest) {
        return $this->render('www/contest.html.twig', [
            'contest' => $contest
        ]);
    }
}