<?php
/**
 * Created by PhpStorm.
 * Profile: marcintha
 * Date: 21/12/2018
 * Time: 11:24
 */

namespace App\Security;


use App\Entity\Profile\Profile;
use App\Repository\ProfileRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ProfileProvider
 *
 * @package App\Security
 */
class ProfileProvider implements UserProviderInterface
{
    /**
     * @var ProfileRepository
     */
    private $repository;

    /**
     * ProfileProvider constructor.
     *
     * @param \App\Repository\ProfileRepository $userRepository
     */
    public function __construct(ProfileRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @param string $username
     * @return \App\Entity\Profile\Profile|null|object|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function loadUserByUsername($username)
    {
        $user = $this->repository->findByUsername($username);
        if (isset($user)) {
            return $user;
        }

        throw new UnsupportedUserException(sprintf("Unable to refresh the user for username: %s", $username));
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \App\Entity\Profile\Profile|null|object|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof Profile) {
            throw new UnsupportedUserException("Profile is invalid");
        }

        // refresh the user
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return Profile::class === $class;
    }
}