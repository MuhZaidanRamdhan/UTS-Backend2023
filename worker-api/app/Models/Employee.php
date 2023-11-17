<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // tabel employees
    protected $table = "employees";

    // mass assignment
    protected $fillable = ["name","gender","phone","address","email","status","hired_on"];

    // membuat relasi tabel statuses
    public function status()
    {
        return $this->belongsTo(Status::class,"status");
    }
}
