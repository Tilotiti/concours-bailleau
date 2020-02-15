<?php


namespace App\Controller\Admin;


use App\Controller\AbstractController;
use App\Entity\Thank;
use App\Form\ThankType;
use App\Form\Filter\ThankFilter;
use App\Repository\ThankRepository;
use App\Service\YearService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ThankController
 * @package App\Controller\Admin
 * @Route("/admin/thank")
 */
class ThankController extends AbstractController
{
    /**
     * @Route("", name="admin_thank")
     * @param Request $request
     * @param ThankRepository $thankRepository
     * @return Response
     */
    public function index(Request $request, ThankRepository $thankRepository)
    {
        $filter = $this->createFilter(ThankFilter::class);
        $filter->handleRequest($request);

        $thanks = $thankRepository->pagination(
            $request->query->getInt('page', 1),
            $filter->getData()
        );

        return $this->render('admin/thank/index.html.twig', [
            'thanks' => $thanks,
            'filter' => $filter->createView()
        ]);
    }

    /**
     * @Route("/add", name="admin_thank_add")
     * @Route("/edit/{thank}", name="admin_thank_edit")
     * @param Request $request
     * @param YearService $yearService
     * @param Thank|null $thank
     * @return Response
     */
    public function form(Request $request, YearService $yearService, ?Thank $thank = null)
    {
        if (!$thank) {
            $thank = new Thank();
            $thank->setYear($yearService->get());
        }

        $form = $this->createForm(ThankType::class, $thank);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($thank);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le remerciement a été enregistré.");
            return $this->redirectToRoute('admin_thank');
        }

        return $this->render('admin/thank/form.html.twig', [
            'form' => $form->createView(),
            'thank' => $thank
        ]);
    }

    /**
     * @Route("/delete/{thank}", name="admin_thank_delete")
     * @param Thank $thank
     * @return RedirectResponse
     */
    public function delete(Thank $thank)
    {
        $this->getDoctrine()->getManager()->remove($thank);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', "Le remerciement a été supprimé.");

        return $this->redirectToRoute('admin_thank');
    }
}