<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApply extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="job_applies";

    public function job_detail()
    {
        return $this->hasOne(Job::class,'job_guid','job_guid');
    }

}
