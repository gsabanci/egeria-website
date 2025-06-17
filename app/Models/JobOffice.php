<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffice extends Model
{
    use HasFactory;

    protected $table="job_offices";
    public $timestamps = false;

    public function office()
    {
        return $this->hasOne(Office::class,'office_guid','office_guid');
    }
}
