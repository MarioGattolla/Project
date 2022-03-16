<?php

namespace App\Actions\Services;

use App\Models\Service;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Http\Request;

class UpdateService
{
    use ActsAsAction;

    public function handle(Request $request, Service $service): bool
    {
        $service->fill($request->all());

        return $service->save();
    }

}
