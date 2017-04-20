<?php
namespace Wisembly\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class AsanaUser implements ResourceOwnerInterface
{
    private $id;
    private $email;

    public function __construct(array $response)
    {
        $this->id = $response['id'];
        $this->email = $response['email'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
        ];
    }
}