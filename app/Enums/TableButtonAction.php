<?php

namespace App\Enums;

enum TableButtonAction: string
{
    case EDIT = 'edit';
    case DELETE = 'delete';
    case RESTORE = 'restore';
}
