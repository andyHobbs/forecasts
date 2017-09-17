<?php

namespace AppBundle\Security\Core\User;

use Symfony\Component\Security\Core\User\UserInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseProvider;

/**
 * FOSUBUserProvider
 */
class FOSUBUserProvider extends BaseProvider
{
    /**
     * {@inheritdoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        /** @var \AppBundle\Entity\User $previousUser */
        $previousUser = $this->userManager->findUserBy([$property => $username]);

        if (null !== $previousUser) {
            $previousUser->setFacebookId(null);
            $previousUser->setFacebookAccessToken(null);
            $this->userManager->updateUser($previousUser);
        }

        $user->setFacebookId($username);
        $user->setFacebookAccessToken($response->getAccessToken());
        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        /** @var \AppBundle\Entity\User $user */
        $user = $this->userManager->findUserBy([$this->getProperty($response) => $username]);

        if (null === $user) {
            $user = $this->userManager->createUser();
            $user->setFacebookId($username);
            $user->setFacebookAccessToken($response->getAccessToken());
            $user->setUsername($response->getFirstName());
            $user->setEmail($response->getEmail());
            $user->setPassword(hash('bcrypt', $response->getNickname()));
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            return $user;
        }

        $user = parent::loadUserByOAuthUserResponse($response);
        $user->setFacebookAccessToken($response->getAccessToken());

        return $user;
    }
}
