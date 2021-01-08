<?php

namespace App\Http\Controllers;

use App\Vancouver;
use Illuminate\Database\Eloquent\Collection;

class VancouverController extends Controller
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Vancouver::all();
    }
}