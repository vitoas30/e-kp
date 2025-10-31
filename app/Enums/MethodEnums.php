<?php

namespace App\Enums;

enum MethodEnums: string
{
    case GET = 'GET';
    case POST = 'POST';
    case SHOW = 'SHOW';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}
