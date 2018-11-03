<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mystore:importproducts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products into the Database from CSV files uploaded by user every 5 minutes.';

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
     * @return mixed
     */
    public function handle()
    {
        if (!$this->importCsvFiles()) {
            echo "One or more CSV files could not be imported to Database.";
        } else {
            echo "CSV files imported succesfuly!";
        }
    }

    private function csvToArray($filename = '', $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = preg_replace("/[^\w\d]/","", $row);
                else 
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    private function importCsvToDatabase($csv_file)
    {
        $products_data = $this->csvToArray($csv_file, ';');

        $data_insert = array();

        for ($i = 0; $i < count($products_data); $i++) {
            $data_insert[] = [
                'name' => $products_data[$i]['name'],
                'description' => $products_data[$i]['description'],
                'image' => $products_data[$i]['image'],
                'price' => $products_data[$i]['price'],
                'category_id' => $products_data[$i]['category_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        return DB::table('products')->insert($data_insert);
    }

    private function importCsvFiles() 
    {
        $success = true;

        $csv_files = Storage::disk('public')->files('csv');

        foreach ($csv_files as $file) {     

            //if (!$this->importCsvToDatabase('public/storage/'.$file)) 
            if (!$this->importCsvToDatabase('public/storage/'.$file)) 
                $success = false;      
        }

        return $success;
    }
}
