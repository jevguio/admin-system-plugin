<?php

namespace plugins\adminsystem\models;

use Illuminate\Database\Eloquent\Model;

class TuitionPayment extends Model
{
    protected $fillable = ['student_id', 'amount', 'payment_date'];
}
