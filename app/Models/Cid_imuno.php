<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cid_imuno extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cid_imuno';
    protected $fillable = ['id','descricao','created_at','updated_at','deleted_at'];
    protected $dates = [''];


}
