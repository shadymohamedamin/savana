<?php

namespace App\Http\Controllers;

class PrimaryDataSubmissionController extends AbstractPrimaryDataController
{
    public function __construct(\App\Repositories\PrimaryDataSubmissionRepository $repo)
    {
        $this->modelClass = \App\Models\PrimaryDataSubmission::class;
        $this->repository = $repo;
        $this->viewFolder = 'primary_datas'; // Reuse same views
        $this->routeName = 'primaryDatasSubmissions';
    }


    
}
