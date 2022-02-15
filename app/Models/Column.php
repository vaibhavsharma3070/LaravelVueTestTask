<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Card;

class Column extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'columns';
    protected $fillable = ['column_id'];

    public function ColumnCardData()
    {
    	return $this->hasMany(Card::class);
    }
}
