<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_to_be_performed',
        'customer',
        'customer_name',
        'construction_of',
        'send_proposal_to',
        'overseas_conditions',
        'base',
        'court_preparation',
        'surfacing',
        'fence',
        'lights',
        'court_accessories',
        'fee',
        'provisions',
        'conditions',
        'guarantee',
        'credit',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
