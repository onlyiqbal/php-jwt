<?php

class Session
{

    public function __construct(public string $username, public string $role)
    {
    }
}

class SessionManager
{
    public static string $SECRET_KEY = "jdhdkdndhdkekxjdjfgfjdddjdjdhdh";

    public static function login(string $username, string $password): bool
    {

        if ($username == "iqbal" && $password == "iqbal") {

            $payload = [
                "username" => $username,
                "role" => "customer"
            ];

            $jwt = \Firebase\JWT\JWT::encode($payload, SessionManager::$SECRET_KEY, 'HS256');

            setcookie("X-IQBAL-SESSION", $jwt);

            return true;
        } else {
            return false;
        }
    }

    public static function getCurrentSession(): Session
    {
        if ($_COOKIE['X-IQBAL-SESSION']) {
            $jwt = $_COOKIE['X-IQBAL-SESSION'];

            try {
                $payload = \Firebase\JWT\JWT::decode($jwt, SessionManager::$SECRET_KEY, ['HS256']);
                return new Session(username: $payload->username, role: $payload->role);
            } catch (Exception $exception) {
                throw new Exception("User is not login");
            }
        } else {
            throw new Exception("User is not login");
        }
    }
}
