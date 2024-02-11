<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db)
    {
    }
    public function isEmailTaken(string $email): bool
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            ['email' => $email]
        )->count();

        if ($emailCount > 0) {
            return true;
        }

        return false;
    }


    public function registerUser(array $data)
    {

        $password = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);

        $this->db->query(
            "INSERT INTO users (email, password, age, country, socila_media_url) VALUES (:email, :password, :age, :country, :social)",
            ['email' => $data["email"], 'password' => $password, 'age' => $data["age"], 'country' => $data["country"], 'social' => $data["social"]]
        );

        session_regenerate_id();

        $_SESSION['user'] = $this->db->getUserId();
    }

    public function login(array $data)
    {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", ['email' => $data['email']])->getData();

        $passwordMatch = password_verify($data["password"], $user["password"] ?? "");

        if (!$user || !$passwordMatch) {
            throw new ValidationException(["password" => "invalid user or password!"]);
        }

        session_regenerate_id();

        $_SESSION["user"] = $user["id"];
    }

    public function logout()
    {
        unset($_SESSION['user']);

        session_regenerate_id();
    }
}
