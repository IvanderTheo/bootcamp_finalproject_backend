<?php

namespace App\Enums;

enum UserRole:string
{
    case User = 'user';
    case Kasir = 'kasir';
    case Karyawan = 'karyawan';
    case Admin = 'admin';
}
