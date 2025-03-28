<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorApproval extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'nid_number',
        'email',
        'personal_phone',
        'mobile_banking_no',
        'business_type',
        'nid_document_path',
        'tin_number',
        'status'
    ];
}
