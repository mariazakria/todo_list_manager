<?php

namespace App\Models;  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $table = 'tasks'; 
    protected $fillable = [
        'title',
        'status',
        'priority',
        'description',
        'due_date',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    

}
