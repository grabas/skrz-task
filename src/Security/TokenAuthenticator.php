<?php
declare(strict_types=1);

namespace App\Security;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use Throwable;

/**
 * Class TokenAuthenticator
 * @package ApiBundle\Security\Authentication
 */
class TokenAuthenticator implements SimplePreAuthenticatorInterface, AuthenticationFailureHandlerInterface
{
    /**
     * @param Request $request
     * @param mixed $providerKey
     * @return PreAuthenticatedToken|void
     */
    public function createToken(Request $request, $providerKey)
    {
        $refreshUrl = '/api/token/refresh';
        $accessUrl = '/api/token/access';

        if ($request->getPathInfo() === $refreshUrl || $request->getPathInfo() === $accessUrl) {
            return;
        }

        $accessToken = $request->headers->get('access-token');

        if ($accessToken === null) {
            throw new BadCredentialsException('Missing Access Token ' . $accessToken);
        }

        return new PreAuthenticatedToken(
            'anon.',
            $accessToken,
            $providerKey
        );
    }

    /**
     * @param TokenInterface $token
     * @param mixed $providerKey
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey): bool
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    /**
     * @param TokenInterface $token
     * @param UserProviderInterface $userProvider
     * @param mixed $providerKey
     * @return PreAuthenticatedToken
     */
    public function authenticateToken(
        TokenInterface $token,
        UserProviderInterface $userProvider,
        $providerKey
    ): PreAuthenticatedToken {
        if (!$userProvider instanceof TokenUserProvider) {
            throw new InvalidArgumentException('The user provider must be an instance of TokenUserProvider (' .  get_class($userProvider) . ' was given).');
        }
        $username = null;
        $token = $token->getCredentials();
        try {
            $username = $userProvider->getUsernameForApiKey($token);
        } catch (Throwable $e) {
            throw new CustomUserMessageAuthenticationException('Token ' . $token . ' does not exist.');
        }

        if ($username === null) {
            throw new CustomUserMessageAuthenticationException('Token ' . $token . ' does not exist.');
        }

        $user = $userProvider->loadUserByUsername($username);

        /** @var array $roles */
        $roles = $user->getRoles();
        return new PreAuthenticatedToken(
            $user,
            [$token],
            $providerKey,
            $roles
        );
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $response = [
            "status" => [
                "code" => 401,
                "message" => "Invalid authorization token",
                'reason' => $exception->getMessage()
            ],
        ];

        return new JsonResponse(
            $response,
            401
        );
    }
}
