<?php

namespace App\ApiResource;

enum TaskStatus: string
{
    case NEW = 'new';
    case PENDING = 'pending';
    case FAILED = 'failed';
    case DONE = 'done';
}
