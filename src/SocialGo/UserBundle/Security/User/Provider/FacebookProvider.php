<?php

namespace SocialGo\UserBundle\Security\User\Provider;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \BaseFacebook;
use \FacebookApiException;

class FacebookProvider implements UserProviderInterface
{

    /**
    * @var \Facebook
    */
    protected $facebook;

    /**
    * @var \FOS\UserBundle\Model\UserManagerInterface
    */
    protected $userManager;

    protected $validator;

    public function __construct(BaseFacebook $facebook, UserManagerInterface $userManager, $validator)
    {
        $this->facebook = $facebook;
        $this->userManager = $userManager;
        $this->validator = $validator;
    }

    public function supportsClass($class)
    {
        return $this->userManager->supportsClass($class);
    }

    public function loadUserByUsername($username)
    {

        try {
            $fbdata = $this->facebook->api('/me?fields=id,email,first_name,last_name,bio,picture');
        } catch (FacebookApiException $e) {
          $fbdata = null;
        }

        if (empty($fbdata)) {
            throw new UsernameNotFoundException('The user was not found');
        }

        if (!$user = $this->userManager->findUserBy(array('facebookID' => $fbdata['id']))) {
            $user = $this->userManager->createUser();
        }

        $user->setUsername($username);
        $user->setEnabled(true);
        $user->setPassword('');

        $user->setFBData($fbdata);

        $this->userManager->updateUser($user);

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user)) || !$user->getFacebookId()) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getFacebookId());
    }

}
