<?php

namespace App\Actions\Services;

use App\Models\Service;
use DefStudio\Actions\Concerns\ActsAsAction;

class DeleteService
{
    use ActsAsAction;

    public function handle(Service $service): ?bool
    {
        return $service->delete();
    }

}
