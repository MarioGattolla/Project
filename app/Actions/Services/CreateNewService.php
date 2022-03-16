<?php

namespace App\Actions\Services;

use App\Models\Service;
use DefStudio\Actions\Concerns\ActsAsAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateNewService
{
    use ActsAsAction;

    public function handle(Request $request): Model|Service
    {
        return Service::create($request->all());
    }

}
