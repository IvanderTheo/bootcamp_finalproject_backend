<?php

namespace App\Enums;

enum CartStatus : string
{
    //
    case Active = 'active';
    case Checkedout = 'checked_out';
}
