<?php

namespace Modules\TaskModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','image'];

    protected static function newFactory()
    {
        return \Modules\TaskModule\Database\factories\CompanyFactory::new();
    }
}
