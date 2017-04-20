<?php
namespace Wisembly\OAuth2\Client\Provider;

use Psr\Http\Message\ResponseInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use League\OAuth2\Client\Token\AccessToken;

class Asana extends AbstractProvider
{
    use BearerAuthorizationTrait;

    const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'id';

    public function getBaseAuthorizationUrl()
    {
        return 'https://app.asana.com/-/oauth_authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://app.asana.com/-/oauth_token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://app.asana.com/api/1.0/users/me';
    }

    public function getDefaultScopes()
    {
        return [];
    }

    public function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw new IdentityProviderException(
                isset($data['message']) ? $data['message'] : $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response
            );
        }
    }

    public function createResourceOwner(array $response, AccessToken $token)
    {
        return new AsanaUser($response);
    }
}