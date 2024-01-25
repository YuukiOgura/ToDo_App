<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'textarea',
        'due_date',
        'priority',
    ];

    /* 
    アクセサを作成して、priorityに登録された値を特定の文字列に変換 
    注意として、型を合わせる為、DB登録時にはint型の[1,2,3]を用いること。
    */
    public function getPriorityAttribute($priority)
    {
        if ($priority === 1) {
            return '重要';
        }
        if ($priority === 2) {
            return '普通';
        }
        if ($priority === 3) {
            return '後回し';
        }
    }


    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
