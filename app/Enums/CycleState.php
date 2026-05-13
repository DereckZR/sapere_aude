<?php

namespace App\Enums;

enum CycleState: string
{
    case CLOSED = 'closed';
    case CURRENT = 'current';
    case UPCOMING = 'upcoming';
}
