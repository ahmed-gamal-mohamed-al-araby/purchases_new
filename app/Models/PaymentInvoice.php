<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['date_invoice'];
    protected $guarded;

    public function item()
    {
        return $this->belongsTo("App\Models\Item","item_id");
    }

    public function project()
    {
        return $this->belongsTo("App\Models\Project","project_id");
    }

    public function supplier()
    {
        return $this->belongsTo("App\Models\Supplier","supplier_id");
    }

    public function bank()
    {
        return $this->belongsTo("App\Models\Bank","bank_id");
    }
}
