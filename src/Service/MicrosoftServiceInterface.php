<?php
namespace Logy\Bundle\MicrosoftBundle\Service;

use Logy\Bundle\MicrosoftBundle\Model\Microsoft\Email\EmailRequest;
use Logy\Bundle\MicrosoftBundle\Model\Token;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;

interface MicrosoftServiceInterface  
{
    const NAME = "microsoft365";

    public function createAuthRedirectResponse(string $scope, string $route, array $params, array $state): RedirectResponse;

    public function requestTokenFromCode(string $code, string $route, array $params): Token;

    public function sendEmail(Token $token, EmailRequest $request, ?bool $retry);

    public function getEmails(Token $token, array $query, ?bool $retry = true) : array;

}