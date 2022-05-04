<?php

namespace App\Enum;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case CREATED = 'created';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';
    case CANCEL = 'cancel';
    case ERROR = 'error';
}
