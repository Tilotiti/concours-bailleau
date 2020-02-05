<?php


namespace App\Controller\Admin;


use App\Controller\AbstractController;
use App\Entity\Year;
use App\Form\YearType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class YearController
 * @package App\Controller\Admin
 * @Route("/admin/year")
 */
class YearController extends AbstractController
{
    /**
     * @Route("", name="admin_year")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $years  = $this->getDoctrine()->getRepository(Year::class)->findBy([], [
            'id' => 'DESC'
        ]);

        return $this->render('admin/year/index.html.twig', [
            'years' => $years
        ]);
    }

    /**
     * @Route("/add", name="admin_year_add")
     * @Route("/edit/{year}", name="admin_year_edit")
     * @param Request $request
     * @param Year|null $year
     * @return Response
     */
    public function form(Request $request, ?Year $year = null) {
        if(!$year) {
            // Création de la prochaine année
            $lastYear = $this->getDoctrine()->getRepository(Year::class)->findBy([], [
                'id' => 'DESC'
            ], 1);

            if(count($lastYear) > 0) {
                $year = new Year();
                $year->setId($lastYear[0]->getId() + 1);
            } else {
                $year = new Year();
            }
        }

        $form = $this->createForm(YearType::class, $year);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($year);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "L'année a été modifiée.");
            return $this->redirectToRoute('admin_year');
        }

        return $this->render('admin/year/form.html.twig', [
            'form' => $form->createView(),
            'item' => $year
        ]);
    }

    /**
     * @Route("/public/{year}", name="admin_year_public")
     * @param Year $year
     * @return RedirectResponse
     */
    public function public(Year $year) {
        $publicYear = $this->getDoctrine()->getRepository(Year::class)->findOneBy([
            'public' => true
        ]);

        if($publicYear) {
            $publicYear->setPublic(false);
        }

        $year->setPublic(true);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_year');
    }
}