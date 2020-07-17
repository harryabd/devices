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
        $csvString = file_get_contents($path);
        $data = $this->parse_csv($csvString);
        $header = array_shift($data);
        foreach ($data as $row) {
            $csv[] = array_combine($header, $row);
        }
        $parts = (array_chunk($csv, 10));
        $i = 1;
        foreach($parts as $line) {
            $filename = base_path('resources/pendingDevices/'.date('y-m-d-H-i-s').$i.'.csv');
            file_put_contents($filename, json_encode($line));
            $i++;
        }

        session()->flash('status', 'queued for importing');

        return redirect("import");
    }

    /**
     * parse_csv handles csvs exported from google docs
     */
    private function parse_csv($csv_string, $delimiter = ",", $skip_empty_lines = true, $trim_fields = true)
    {
        $enc = preg_replace('/(?<!")""/', '!!Q!!', $csv_string);
        $enc = preg_replace_callback(
            '/"(.*?)"/s',
            function ($field) {
                return urlencode(utf8_encode($field[1]));
            },
            $enc
        );
        $lines = preg_split($skip_empty_lines ? ($trim_fields ? '/( *\R)+/s' : '/\R+/s') : '/\R/s', $enc);
        return array_map(
            function ($line) use ($delimiter, $trim_fields) {
                $fields = $trim_fields ? array_map('trim', explode($delimiter, $line)) : explode($delimiter, $line);
                return array_map(
                    function ($field) {
                        return str_replace('!!Q!!', '"', utf8_decode(urldecode($field)));
                    },
                    $fields
                );
            },
            $lines
        );
    }
}
