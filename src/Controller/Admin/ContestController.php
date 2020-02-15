<?php


namespace App\Controller\Admin;


use App\Controller\AbstractController;
use App\Entity\Contest;
use App\Form\ContestType;
use App\Form\Filter\ContestFilter;
use App\Repository\ContestRepository;
use App\Service\YearService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContestController
 * @package App\Controller\Admin
 * @Route("/admin/contest")
 */
class ContestController extends AbstractController
{
    /**
     * @Route("", name="admin_contest")
     * @param Request $request
     * @param ContestRepository $contestRepository
     * @return Response
     */
    public function index(Request $request, ContestRepository $contestRepository)
    {
        $filter = $this->createFilter(ContestFilter::class);
        $filter->handleRequest($request);

        $contests = $contestRepository->pagination(
            $request->query->getInt('page', 1),
            $filter->getData()
        );

        return $this->render('admin/contest/index.html.twig', [
            'contests' => $contests,
            'filter' => $filter->createView()
        ]);
    }

    /**
     * @Route("/add", name="admin_contest_add")
     * @Route("/edit/{contest}", name="admin_contest_edit")
     * @param Request $request
     * @param YearService $yearService
     * @param Contest|null $contest
     * @return Response
     */
    public function form(Request $request, YearService $yearService, ?Contest $contest = null)
    {
        if (!$contest) {
            $contest = new Contest();
            $contest->setYear($yearService->get());
        }

        $form = $this->createForm(ContestType::class, $contest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($contest);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le concours a été modifié.");
            return $this->redirectToRoute('admin_contest');
        }

        return $this->render('admin/contest/form.html.twig', [
            'form' => $form->createView(),
            'contest' => $contest
        ]);
    }

    /**
     * @Route("/delete/{contest}", name="admin_contest_delete")
     * @param Contest $contest
     * @return RedirectResponse
     */
    public function delete(Contest $contest)
    {
        $this->getDoctrine()->getManager()->remove($contest);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', "Le concours a été supprimé.");

        return $this->redirectToRoute('admin_contest');
    }
}