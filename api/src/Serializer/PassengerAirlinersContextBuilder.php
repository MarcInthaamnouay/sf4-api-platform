<?php
/**
 * Created by PhpStorm.
 * User: marcintha
 * Date: 21/12/2018
 * Time: 17:07
 */

namespace App\Serializer;

use ApiPlatform\Core\Exception\RuntimeException;
use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class PassengerAirlinersContextBuilder
 *
 * @package App\Serializer
 */
class PassengerAirlinersContextBuilder implements SerializerContextBuilderInterface
{
    /**
     * @var SerializerContextBuilderInterface
     */
    private $decorated;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * PassengerAirlinersContextBuilder constructor.
     *
     * @param \ApiPlatform\Core\Serializer\SerializerContextBuilderInterface $decorated
     * @param \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        SerializerContextBuilderInterface $decorated,
        AuthorizationCheckerInterface $authorizationChecker
    ){
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param bool $normalization
     * @param array|null $extractedAttributes
     * @return array
     */
    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null): array
    {

    }

}