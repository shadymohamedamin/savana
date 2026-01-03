<?php

namespace App\Repositories;

use App\Models\Attachment;
use App\Repositories\BaseRepository;

class AttachmentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'CaseID',
        'AttID',
        'AttPath',
        'Remarks',
        'Preview',
        'Delete'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Attachment::class;
    }
    public function delete($ID)
    {
        \Log::info('Starting delete logic for attachment ID: ' . $ID);

        $attachment = Attachment::find($ID);

        if (!$attachment) {
            \Log::warning('Attachment not found: ' . $ID);
            return response()->json(['error' => 'Attachment not found.'], 404);
        }

        // Remove the unnecessary server path from AttPath if present
        $cleanPath = str_replace(['\\', 'svr/RAKcMainApp$/'], '/', $attachment->AttPath);
        $cleanPath = preg_replace('#^/+|/+$#', '', $cleanPath); // Remove leading/trailing slashes
        $fullPath = public_path($cleanPath);

        \Log::info('Resolved full file path: ' . $fullPath);

        // Delete file
        if (file_exists($fullPath)) {
            unlink($fullPath);
            \Log::info('File deleted from disk: ' . $fullPath);
        } else {
            \Log::warning('File does not exist: ' . $fullPath);
        }

        // Delete DB row
        $attachment->delete();
        \Log::info('Database row deleted for attachment ID: ' . $ID);

        return response()->json(['success' => 'Attachment file and record deleted.']);
    }
    public function update(array $data, $ID)
    {
        $attachment = $this->model->find($ID);

        if ($attachment) {
            $attachment->update($data);
        }

        return $attachment;
    }


}
