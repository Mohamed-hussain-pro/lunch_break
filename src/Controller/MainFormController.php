<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class MainFormController extends AbstractController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    #[Route('/save_choices', name: 'save_choices')]
    public function saveChoices(Request $request): Response
    {
        // write logig to save the data and redirect to main
        return $this->redirectToRoute('app_main');

    }
    
    #[Route('/get-resturant', name: 'get_resturant')]
    public function getResturant(Request $request): Response
    {
        $data = $this->apiService->fetchData();

        if ($request->isMethod('POST')) {
            //$selectedOptions = $request->request->get('multiselectField');
            return $this->render('main/choices.html.twig', [
                'controller_name' => 'MainFormController',
                'temp' => $data['main']['temp']
            ]);
        }

        return $this->render('main/choices.html.twig');
    }



}
