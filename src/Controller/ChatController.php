<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[AsController]
class ChatController
{
    public function __construct(private Environment $template)
    {
    }

    #[Route(path: "/chat", name: "chat", methods: [Request::METHOD_GET])]
    public function __invoke(): Response
    {
        return new Response($this->template->render('chat.html.twig'));
    }
}