<?php

namespace App\Controller;

use App\Form\FormType;
use App\Service\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PrimeNumberController extends AbstractController
{
    #[Route('/primenumber', name: 'app_prime_number')]
    public function index(Request $request,Service $service): Response
    {
        $form = $this->createForm(formType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $data = $form->getData();
        $primenumbers = $service->prime($data['first'],$data['second']);
        #dd($primenumbers);
        
       
        return $this->render('prime_number/output.html.twig', [
            'prime_numbers' => $primenumbers,
        ]);
    }
        return $this->render('prime_number/index.html.twig', [
            'form' => $form,
        ]);
    }
}
