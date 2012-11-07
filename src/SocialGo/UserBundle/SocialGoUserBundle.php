<?php

namespace SocialGo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SocialGoUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
