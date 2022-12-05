<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{
    use HasFactory;
    public $table ='app_content';
    public $primaryKey="id";
    public $incrementing=true;
    public $keyType="int";
    public $timestamps = true;
}
