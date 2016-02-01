<?php

namespace DR\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArtController extends Controller
{
    public function indexAction()
    {
		return $this->render('DRPlatformBundle:Art:index.html.twig');
    }
}