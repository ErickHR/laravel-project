<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /** @use HasFactory<\Database\Factories\PermissionFactory> */
    use HasFactory;

    protected $fillable = [
      'role_id',
      'uri_id',
      'method_id',
    ];

    public function uri() {
      return $this->belongsTo(Uri::class);
    }

    public function method() {
      return $this->belongsTo(Method::class);
    }
}
