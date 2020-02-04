<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 * @Route("{_locale}", requirements={"_locale": "en|fr|"}, defaults={"fr"})
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

    }
}