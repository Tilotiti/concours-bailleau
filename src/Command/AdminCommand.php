<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AdminCommand extends Command
{
    protected static $defaultName = 'app:admin';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * AdminCommand constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, ValidatorInterface $validator, EntityManagerInterface $entityManager, MailerInterface $mailer)
    {
        parent::__construct();

        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create an admin')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $helper = $this->getHelper('question');

        $question = new Question('Adresse e-mail', 'thibault@henry.pro');

        $email = $helper->ask($input, $output, $question);

        $user = new User();
        $user->setEmail($email);

        $question = new Question('Prénom', 'Thibault');

        $firstname = $helper->ask($input, $output, $question);

        $user->setFirstname($firstname);

        $question = new Question('Nom de famille', 'Henry');

        $lastname = $helper->ask($input, $output, $question);

        $user->setLastname($lastname);

        $user->setRole(User::ROLE_ADMIN);

        $plainPasswod = substr(md5(time()), 0, 12);

        $password = $this->userPasswordEncoder->encodePassword($user, $plainPasswod);

        $user->setPassword($password);

        $errors = $this->validator->validate($user);

        if(count($errors) > 0) {
            $io->error((string) $errors);

            return 1;
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $email = new TemplatedEmail();
        $email->from('concours@planeur-bailleau.org');
        $email->to($user->getEmail());
        $email->subject('[Concours Bailleau] Votre mot de passe');
        $email->htmlTemplate('email/admin.html.twig');
        $email->context([
            'user' => $user,
            'password' => $plainPasswod
        ]);

        $this->mailer->send($email);

        return 0;
    }
}
