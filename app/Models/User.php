<?php

declare(strict_types=1);

namespace App\Models;

use System\Database\MyModel\Model;

/**
 * @property string|null $user
 * @property string|null $password
 */
class User extends Model
{
    protected string $tableName  = 'users';
    protected string $primaryKey = 'user';
}
