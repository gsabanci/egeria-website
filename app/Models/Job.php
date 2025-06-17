<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="jobs";

    public function office()
    {
        return $this->hasOne(Office::class,'office_guid','office_guid');
    }

    public function applies()
    {
        return $this->hasMany(JobApply::class,'ja_guid','ja_guid');
    }

    public function offices()
    {
        return $this->hasMany(JobOffice::class,'job_guid','job_guid');
    }
}
