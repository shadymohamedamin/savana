<?php

namespace App\Repositories;

use App\Models\PrimaryDataSubmission;

class PrimaryDataSubmissionRepository extends BasePrimaryDataRepository
{
    public function model(): string
    {
        return PrimaryDataSubmission::class;
    }
}
