<?php
namespace Wisembly\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class AsanaUser implements ResourceOwnerInterface
{
    private $id;
    private $email;
    private $name;
    private $photo;

    public function __construct(array $response)
    {
        $this->id = $response['data']['gid'];
        $this->email = $response['data']['email'];
        $this->name = $response['data']['name'];
        $this->photo = $response['data']['photo'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'photo' => $this->photo,
        ];
    }
}