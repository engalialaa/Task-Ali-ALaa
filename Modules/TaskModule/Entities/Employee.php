<?php

namespace Modules\TaskModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','name','email','password','image'];

    protected static function newFactory()
    {
        return \Modules\TaskModule\Database\factories\EmployeeFactory::new();
    }


    public function company()
    {
        return $this->belongsTo(company::class,'company_id');
    }

}
