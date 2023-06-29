<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'department_types';

    // public function deparment_names(){
    //     return $this->hasMany('DepartmentName');
    // }
}
