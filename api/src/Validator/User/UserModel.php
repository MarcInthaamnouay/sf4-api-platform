<?php
/**
 * Created by PhpStorm.
 * Profile: marcintha
 * Date: 21/12/2018
 * Time: 11:53
 */

namespace App\Validator\User;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserModel
 *
 * @package App\Validator\Profile
 */
class UserModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     */
    public $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     */
    public $password;

    /**
     * @var array
     *
     * @Assert\NotBlank()
     * @Assert\Choice({"ROLE_USER", "ROLE_ADMIN"})
     */
    public $roles;
}