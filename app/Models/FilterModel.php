<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterModel extends Model
{
    use HasFactory;
    protected $table = 'user_mgts';
    protected $primarykey = 'id';
}
