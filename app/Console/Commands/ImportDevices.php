<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Device;
use App\Upload;

class ImportDevices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:devices {limit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import devices from csv files in pendingDevices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = $this->argument('limit');
        $filePattern = base_path("resources/pendingDevices/*.csv");
        foreach (array_slice(glob($filePattern), 0, $limit) as $file)
        {
            // Create upload/import entity
            $upload = Upload::create([
                'filepath' => $file
            ]);
            $data = file_get_contents($file);
            $array = json_decode($data);
            foreach ($array as $row) {
                $row->upload_id = $upload->id;
                if ($row->install_date = Device::validateDateInput($row->install_date)) {
                    $row = (array) $row;
                    // Create/update record with the import file id + data from the csv
                    Device::create($row);
                } else {
                    // Ignore invalid date inputs
                    continue;
                }
            }

            // Move file to archive folder + update import entity with new filepath
            $directory = dirname($file, 2);
            $filename = basename($file);
            rename($file, $directory . '/processedDevices/' . $filename);
            $upload->filepath = $directory . '/processedDevices/' . $filename;
            $upload->save();
        }

        return 0;
    }


}
