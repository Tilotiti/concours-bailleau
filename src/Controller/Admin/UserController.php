<?php


namespace App\Controller\Admin;


use App\Controller\AbstractController;
use App\Entity\User;
use App\Form\Filter\UserFilter;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller\Admin
 * @Route("/admin/user")
 * @IsGranted("ROLE_ADMIN")
 */
class UserController extends AbstractController
{
    /**
     * @Route("", name="admin_user")
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $filter = $this->createFilter(UserFilter::class);

        $users = $userRepository->pagination(
            $request->query->getInt('page', 1),
            $filter->getData()
        );

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
            'filter' => $filter->createView()
        ]);
    }

    /**
     * @Route("/add", name="admin_user_add")
     * @Route("/edit/{user}", name="admin_user_edit")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param PasswordEncoderInterface $passwordEncoder
     * @param MailerInterface $mailer
     * @param User|null $user
     * @return RedirectResponse|Response
     * @throws TransportExceptionInterface
     */
    public function form(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        MailerInterface $mailer,
        ?User $user = null
    )
    {
        if(!$user) {
            $user = new User();
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$user->getId()) {
                $user->setRoles([User::ROLE_ADMIN]);

                $plainPasswod = substr(md5(time()), 0, 12);

                $password = $passwordEncoder->encodePassword($user, $plainPasswod);

                $user->setPassword($password);

                $email = new TemplatedEmail();
                $email->from('concours@planeur-bailleau.org');
                $email->to($user->getEmail());
                $email->subject('[Concours Bailleau] Votre mot de passe');
                $email->htmlTemplate('email/admin.html.twig');
                $email->context([
                    'user' => $user,
                    'password' => $plainPasswod
                ]);

                $mailer->send($email);

                $entityManager->persist($user);

                $this->addFlash('success', "L'utilisateur a été créé. Un invitation vient d'être envoyée par mot de passe.");
            } else {
                $this->addFlash('success', "L'utilisateur a été modifié.");
            }

            $entityManager->flush();

            return $this->redirectToRoute('admin_user');
        }

        return $this->render('admin/user/form.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}