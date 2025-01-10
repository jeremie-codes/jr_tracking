<?php

namespace App\Repository\User;

use App\Contracts\BaseOpContract;

interface UserContract extends BaseOpContract
{
    function login($credentials = array());
    function logout($id);
    function createToken($id);
}