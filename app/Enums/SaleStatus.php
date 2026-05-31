<?php

namespace App\Enums;

enum SaleStatus : string
{
    //
    case Paid = 'paid';
    case Completed = 'completed';
    case Ongoing = 'ongoing';
    case Cancelled = 'cancelled';
}
