<?php

namespace App\Repositories;

interface LoginRepositoryInterface
{
    public function login(array $credentials);
    public function logout();
    public function refresh();
    public function getAuthenticatedUser();
}
