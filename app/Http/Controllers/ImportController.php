<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * import is bount to the GET /import/ endpoint
     *
     * @return void
     */
    public function import()
    {
        return view('import');
    }

    /**
     * parseImport is bound to the POST /import/ endpoint
     * Takes a csv file and splits into 100 line chunks for later consumption
     *
     * @return void
     */
    public function parseImport()
    {
        request()->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
        $path = request()->file('file')->getRealPath();
        $file = file($path);
        $data = array_slice($file, 1);

        $parts = (array_chunk($data, 100));
        $i = 1;
        foreach($parts as $line) {
            $filename = base_path('resources/pendingDevices/'.date('y-m-d-H-i-s').$i.'.csv');
            file_put_contents($filename, $line);
            $i++;
        }

        session()->flash('status', 'queued for importing');

        return redirect("import");
    }
}
