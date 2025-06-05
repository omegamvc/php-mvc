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
    /** @var string Holds the table name to use. */
    protected string $tableName  = 'users';

    /** @var string Holds the primary key to use. */
    protected string $primaryKey = 'user';
}
