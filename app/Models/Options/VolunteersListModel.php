<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VolunteersListModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public $table ='content_volunteers';
    public $primaryKey="id";
    public $incrementing=true;
    public $keyType="int";
    public $timestamps = true;
}
