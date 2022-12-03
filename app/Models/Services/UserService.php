<?php

namespace Models\Services;

use Models\Brokers\UserBroker;
use Models\Validators\UserValidator;
use stdClass;
use Zephyrus\Application\Form;
use Zephyrus\Security\Cryptography;

class UserService
{
    public static function findUserByUsername(string $username): ?stdClass
    {
        return (new UserBroker())->findByUsername($username);
    }

    public static function findUserByID(int $id): ?array
    {
        return (new UserBroker())->findByID($id);
    }

    public static function createAccount(array $userInfo): ?int
    {
        $verified = UserValidator::assert($userInfo);
        if (!$verified) return -1;
        if (self::findUserByUsername($userInfo['username']) == null) {
            return (new UserBroker())->createAccount($userInfo);
        }
        return 0;
    }

    public static function login(array $userInfo): ?stdClass
    {
        $user = self::findUserByUsername($userInfo["username"]);
        if ($user == null || !Cryptography::verifyHashedPassword($userInfo["password"], $user->password))
            return null;
        return $user;
    }
}