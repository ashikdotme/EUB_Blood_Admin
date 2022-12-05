<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FemaleCodeModel extends Model
{
    use HasFactory;
    public $table ='female_codes';
    public $primaryKey="id";
    public $incrementing=true;
    public $keyType="int";
    public $timestamps = false;
}
