<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;

    protected $table = 'Chatbot';

    protected $primaryKey = 'Chatbot_ID';

    public $timestamps = false;

    public function systemSetting()
    {
        return $this->belongsTo(
            SystemSetting::class,
            'System_ID',
            'System_ID'
        );
    }
}