<?php

namespace App\Enums;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'UserRole',
    description: 'The role assigned to a user',
    type: 'string',
    example: 'user',
    enum: ['admin', 'editor', 'user']
)]
enum UserRole: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case USER = 'user';
}
