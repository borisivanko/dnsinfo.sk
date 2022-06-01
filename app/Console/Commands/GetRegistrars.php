<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GetRegistrars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrars:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all registrars from sk-nic.sk/subory/registrars.txt';

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
        DB::beginTransaction();

        DB::delete('DELETE FROM registrars');

        $data = file_get_contents('https://sk-nic.sk/subory/registrars.txt');
        file_put_contents(storage_path('app/registrars.txt'), $data);

        $handle = fopen(storage_path('app/registrars.txt'), 'rb');
        if(false === $handle){
            exit("Failed to open stream to URL");
        }

        while(!feof($handle)){
            $line = fgets($handle);

            if (substr($line, 0, 2) !== "--" && substr($line, 0, 7) !== 'Reg ID;') {
                $values = str_getcsv($line, ';');
//                TODO: remove if statement below
                if ($values[0]) {
                    DB::insert('INSERT INTO registrars (id, registrar_id, company, street_name, city_name, contact_phone, contact_email) VALUES (?, ?, ?, ?, ?, ?, ?)',
                        [Str::uuid(), $values[0], $values[1], $values[2], $values[3], $values[4], $values[5]]);
                }
            }
        }

        DB::commit();

        fclose($handle);

        return 0;
    }
}
