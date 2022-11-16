<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Joao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'joao';
    protected $fillable = ['id','nome','idade'];
    protected $dates = [''];


}
