<?php


namespace App\Controller;


use App\Entity\Contest;
use App\Form\ContactType;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
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
     * @param Request $request
     * @param UserRepository $userRepository
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function contact(Request $request, UserRepository $userRepository, MailerInterface $mailer) {
        $form = $this->createFilter(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $emails = [];

            $users = $userRepository->findAll();

            foreach($users as $user) {
                $emails[] = $user->getEmail();
            }

            $email = new TemplatedEmail();
            $email->from('concours@planeur-bailleau.org');
            $email->to($emails);
            $email->subject('[Concours Bailleau] Nouveau message');
            $email->htmlTemplate('email/contact.html.twig');
            $email->context([
                'data' => $form->getData()
            ]);

            $mailer->send($email);

            $this->addFlash('success', "contact.success");
            return $this->redirectToRoute('www_contact');
        }

        return $this->render('www/contact.html.twig', [
            'form' => $form->createView()
        ]);
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