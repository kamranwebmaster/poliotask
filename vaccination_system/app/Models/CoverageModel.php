<?php

namespace App\Models;

use CodeIgniter\Model;

class CoverageModel extends Model
{
    // Set the table name where the coverage data will be stored
    protected $table = 'coverage'; 

    // Define the primary key of the table
    protected $primaryKey = 'coverage_id';

    // Define the allowed fields to be inserted/updated
    protected $allowedFields = ['campaign_id', 'coverage'];

    // Optionally, define validation rules
    // protected $validationRules = [
    //     'campaign_id'   => 'required|is_natural_no_zero',
    //     'coverage'      => 'required|decimal',
    //     'submitted_by'  => 'required|is_natural_no_zero',
    //     'submitted_at'  => 'required|valid_date',
    // ];

    // Optionally, define validation messages
    protected $validationMessages = [
        'campaign_id'   => [
            'required' => 'Campaign ID is required.',
            'is_natural_no_zero' => 'Campaign ID must be a valid number.',
        ],
        'coverage'      => [
            'required' => 'Coverage is required.',
            'decimal'  => 'Coverage must be a valid decimal number.',
        ],
        'submitted_by'  => [
            'required' => 'Submitted by field is required.',
            'is_natural_no_zero' => 'Submitted by must be a valid user ID.',
        ],
        'submitted_at'  => [
            'required' => 'Submitted at timestamp is required.',
            'valid_date' => 'Submitted at must be a valid date.',
        ]
    ];

    // You can also define return types for better data consistency
    protected $returnType = 'array';  // Returns data as an associative array
}
