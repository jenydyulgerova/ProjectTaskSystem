<?php

namespace App\ApiResource;

enum ProjectStatus: string
{
    case NEW = 'new';
    case PENDING = 'pending';
    case FAILED = 'failed';
    case DONE = 'done';
}
