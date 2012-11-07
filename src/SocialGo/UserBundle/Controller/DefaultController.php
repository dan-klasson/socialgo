<?php

namespace SocialGo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {

        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirect($this->generateUrl('profile'));
        }

        return array();
    }

    /**
     * @Route("/profile")
     * @Secure(roles="ROLE_USER")
     * @Template("SocialGoUserBundle:Profile:profile.html.twig")
     */
    public function profileAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        return array('user' => $user);
    }
}
