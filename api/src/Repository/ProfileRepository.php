<?php
/**
 * Created by PhpStorm.
 * Profile: marcintha
 * Date: 21/12/2018
 * Time: 11:21
 */

namespace App\Repository;

use App\Entity\Profile\Profile;
use App\Validator\User\UserModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class ProfileRepository
 *
 * @package App\Repository
 */
class ProfileRepository
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * ProfileRepository constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $encoder
    ){
        $this->repository = $entityManager->getRepository(Profile::class);
        $this->em = $entityManager;
        $this->encoder = $encoder;
    }

    /**
     * @param string $username
     * @return \App\Entity\Profile\Profile|null|object
     */
    public function findByUsername(string $username) {
        return $this->repository->findOneBy([
            'username' => $username
        ]);
    }

    /**
     * @param \App\Validator\User\UserModel $model
     * @return \App\Entity\Profile\Profile
     */
    public function createUser(UserModel $model) {
        $user = new Profile();

        $user->setUsername($model->username);
        $user->setPassword($this->encoder->encodePassword($user, $model->password));
        $user->setRoles([$model->roles]);

        return $user;
    }

    /**
     * @param \App\Entity\Profile\Profile $user
     * @return string
     */
    public function save(Profile $user) {
        try {
            $this->em->persist($user);
            $this->em->flush();
        } catch (\Exception $e) {
            return $e->getTraceAsString();
        }
    }
}