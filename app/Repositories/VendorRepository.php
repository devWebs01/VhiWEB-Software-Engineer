<?php

namespace App\Repositories;

use App\Models\Vendor;

class VendorRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Vendor::class;
    }
}
