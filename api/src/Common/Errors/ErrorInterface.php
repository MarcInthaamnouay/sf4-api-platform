<?php
/**
 * Created by PhpStorm.
 * Profile: marcintha
 * Date: 21/12/2018
 * Time: 12:05
 */

namespace App\Common\Errors;


interface ErrorInterface
{
    public const INVALID_FORM = "The form is invalid";
    public const USERNAME_EXIST = "The usesrname already exist";
}