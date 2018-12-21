<?php
/**
 * Created by PhpStorm.
 * Profile: marcintha
 * Date: 21/12/2018
 * Time: 11:51
 */

namespace App\Controller;


use App\Common\Errors\ErrorInterface;
use App\Form\Profile\ProfileFormType;
use App\Repository\ProfileRepository;
use App\Validator\User\UserModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProfileController
 *
 * @package App\Controller
 */
class ProfileController extends AbstractController
{
    /**
     * @var \App\Repository\ProfileRepository
     */
    private $repository;

    /**
     * ProfileController constructor.
     *
     * @param \App\Repository\ProfileRepository $userRepository
     */
    public function __construct(
        ProfileRepository $userRepository
    ){
        $this->repository = $userRepository;
    }

    /**
     * @Route("/register", name="register", methods={"POST"})
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function registerAction(Request $request) {
        $model = new UserModel();

        // create form
        $form = $this->createForm(ProfileFormType::class, $model);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->repository->findByUsername($model->username);
            if (isset($user)) {
                return new JsonResponse([
                    'error' => ErrorInterface::USERNAME_EXIST
                ]);
            }

            $user = $this->repository->createUser($model);
            $error = $this->repository->save($user);

            if (isset($error)) {
                return new JsonResponse([
                    'error' => $error
                ]);
            }

            return new JsonResponse([
                'data' => 'success'
            ]);
        }

        return new JsonResponse([
            'error' => ErrorInterface::INVALID_FORM
        ]);
    }
}