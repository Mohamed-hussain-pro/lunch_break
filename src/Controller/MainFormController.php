<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainFormController extends AbstractController
{
    public function yourAction(Request $request): Response
    {
        // Handle form submission
        if ($request->isMethod('POST')) {
            $selectedOptions = $request->request->get('multiselectField');

            // Process selected options
            // You can do whatever you want with the selected options here

            // For example, you can print them
            foreach ($selectedOptions as $option) {
                echo $option . '<br>';
            }

            // Or redirect somewhere
            return $this->redirectToRoute('your_redirect_route');
        }

        // Render the form
        return $this->render('your_template.html.twig');
    }
}
