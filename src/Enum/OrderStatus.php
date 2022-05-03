<?php

namespace App\Enum;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case CREATED = 'created';
    case FINISHED = 'finished';
    case ERROR = 'error';
}
