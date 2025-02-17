<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceEntry extends Model
{
    use HasFactory;

    // تحديد الجدول المرتبط بالنموذج
    protected $table = 'invoice_entries';

    // تحديد الأعمدة القابلة للتعبئة بشكل جماعي
    protected $fillable = [
        'invoice_id',
        'item_id',         // إضافة item_id
        'description',
        'quantity',
        'unit_price',
        'tax',             // إضافة قيمة الضريبة
        'discount',        // إضافة قيمة الخصم
        'total'
    ];

    // العلاقة مع نموذج Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    
    // العلاقة مع نموذج Item (إذا كان لديك نموذج للعناصر)
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
