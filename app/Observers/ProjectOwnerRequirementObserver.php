<?php

namespace App\Observers;

use App\Models\ProjectOwnerRequirement;

class ProjectOwnerRequirementObserver
{
    /**
     * Handle the ProjectOwnerRequirement "created" event.
     */
    public function saving(ProjectOwnerRequirement $model)
    {
        $model->total_price =
            ($model->quantity ?? 0) * ($model->unit_price ?? 0);
    }


    public function created(ProjectOwnerRequirement $projectOwnerRequirement): void
    {
        //
    }

    /**
     * Handle the ProjectOwnerRequirement "updated" event.
     */
    public function updated(ProjectOwnerRequirement $projectOwnerRequirement): void
    {
        //
    }

    /**
     * Handle the ProjectOwnerRequirement "deleted" event.
     */
    public function deleted(ProjectOwnerRequirement $projectOwnerRequirement): void
    {
        //
    }

    /**
     * Handle the ProjectOwnerRequirement "restored" event.
     */
    public function restored(ProjectOwnerRequirement $projectOwnerRequirement): void
    {
        //
    }

    /**
     * Handle the ProjectOwnerRequirement "force deleted" event.
     */
    public function forceDeleted(ProjectOwnerRequirement $projectOwnerRequirement): void
    {
        //
    }
}
