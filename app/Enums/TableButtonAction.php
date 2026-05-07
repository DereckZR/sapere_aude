<?php

namespace App\Enums;

enum TableButtonAction: string
{
    case SHOW = 'show';
    case EDIT = 'edit';
    case DELETE = 'delete';
    case RESTORE = 'restore';
}
