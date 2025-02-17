<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // تحديد الجدول المرتبط بالنموذج
    protected $table = 'invoices';

    // تحديد الأعمدة القابلة للتعبئة بشكل جماعي
    protected $fillable = [
        'client_id',
        'invoice_number',
        'project_id',
        'invoice_type',
        'issue_date',
        'due_date',
        'subtotal',
        'tax',
        'total',
        'payment_method',
        'payment_terms',
        'notes'
    ];

    // العلاقة مع نموذج Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // العلاقة مع نموذج InvoiceItem
    public function items()
    {
        return $this->hasMany(InvoiceEntry::class);
    }
}

