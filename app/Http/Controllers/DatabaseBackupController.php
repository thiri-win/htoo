<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseBackupController extends Controller
{
    public function download()
    {
        $path = database_path('database.sqlite');
        if(!file_exists($path)) {
            abort(404, 'Database file not found');
        }
        return response()->download($path, 'database.sqlite');
    }
}
