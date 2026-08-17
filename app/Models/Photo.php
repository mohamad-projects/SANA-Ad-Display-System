<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'user_id'];

    /**
     * العلاقة العكسية: الصورة تنتمي لمستخدم واحد
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
