<?php


namespace App\Controller\Admin;


use App\Controller\AbstractController;
use App\Entity\Partner;
use App\Form\PartnerType;
use App\Form\Filter\PartnerFilter;
use App\Repository\PartnerRepository;
use App\Service\StorageService;
use App\Service\YearService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PartnerController
 * @package App\Controller\Admin
 * @Route("/admin/partner")
 */
class PartnerController extends AbstractController
{
    /**
     * @Route("", name="admin_partner")
     * @param Request $request
     * @param PartnerRepository $partnerRepository
     * @return Response
     */
    public function index(Request $request, PartnerRepository $partnerRepository)
    {
        $filter = $this->createFilter(PartnerFilter::class);
        $filter->handleRequest($request);

        $partners = $partnerRepository->pagination(
            $request->query->getInt('page', 1),
            $filter->getData()
        );

        return $this->render('admin/partner/index.html.twig', [
            'partners' => $partners,
            'filter' => $filter->createView()
        ]);
    }

    /**
     * @Route("/add", name="admin_partner_add")
     * @Route("/edit/{partner}", name="admin_partner_edit")
     * @param Request $request
     * @param YearService $yearService
     * @param StorageService $storage
     * @param Partner|null $partner
     * @return Response
     */
    public function form(Request $request, YearService $yearService, StorageService $storage, ?Partner $partner = null)
    {
        if (!$partner) {
            $partner = new Partner();
            $partner->setYear($yearService->get());
        }

        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($partner->getFile()) {
                $filename = 'partners/'.time().'.'.$partner->getFile()->getClientOriginalName();

                $url = $storage->uploadFile($filename, $partner->getFile());

                $partner->setLogo($url);
            }

            $this->getDoctrine()->getManager()->persist($partner);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Le partenaire a été enregistré.");
            return $this->redirectToRoute('admin_partner');
        }

        return $this->render('admin/partner/form.html.twig', [
            'form' => $form->createView(),
            'partner' => $partner
        ]);
    }

    /**
     * @Route("/delete/{partner}", name="admin_partner_delete")
     * @param Partner $partner
     * @return RedirectResponse
     */
    public function delete(Partner $partner)
    {
        $this->getDoctrine()->getManager()->remove($partner);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('success', "Le partenaire a été supprimé.");

        return $this->redirectToRoute('admin_partner');
    }
}