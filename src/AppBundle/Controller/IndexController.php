<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexController
 * @package AppBundle\Controller
 * @author Andrei Berezin <yago.spb@gmail.com>
 */
class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template("@App/Index/index.html.twig")
     */
    public function indexAction()
    {
        return [];
    }

}
