<?php
namespace App\Plugins\TuitionPayment\Models;

use Illuminate\Database\Eloquent\Model;

class TuitionPayment extends Model
{
    protected $fillable = ['student_id', 'amount', 'payment_date'];
}
