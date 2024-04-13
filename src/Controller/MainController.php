<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MainController extends AbstractController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    #[Route('/', name: 'app_main')]
    public function index(ParameterBagInterface $parameterBag): Response
    {

        $data = $this->apiService->fetchData();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'temp' => $data['main']['temp']
        ]);
    }

    #[Route('/selected-choices-list', name: 'selected_choices_list')]
    public function showSelectedChoices(): Response
    {
        $data = $this->apiService->fetchData();

        return $this->render('main/selected_choices_list.html.twig', ['temp' => $data['main']['temp']]);
    }
}
