<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      schema="Vendor",
 *      required={"user_id","company_name","contact_person","email","phone","address","status"},
 *
 *      @OA\Property(
 *          property="user_id",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="company_name",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="contact_person",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="phone",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="address",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="status",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="boolean",
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */ class Vendor extends Model
{
    use HasFactory;

    public $table = 'vendors';

    public $fillable = [
        'user_id',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'status',
    ];

    protected $casts = [
        'company_name' => 'string',
        'contact_person' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'status' => 'boolean',
    ];

    public static array $rules = [
        'user_id' => 'required|exists:users,id',
        'company_name' => 'required|string|min:3',
        'contact_person' => 'required|string|min:3',
        'email' => 'required|email|unique:vendors,email',
        'phone' => 'required|string',
        'address' => 'required|string',
        'status' => 'required|boolean',
    ];
}
