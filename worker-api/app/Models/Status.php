<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    // tabel statuses
    protected $table = "statuses";

    // mass assignment
    protected $fillable = ["name_status"];
}
