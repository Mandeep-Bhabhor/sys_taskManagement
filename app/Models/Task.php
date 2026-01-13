<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
       
       'title',
       'status',
       'staff_id',

    ];

    public function staff(){
        return $this->belongsTo(User::class,'staff_id');
    }
}
