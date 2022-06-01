<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GetDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domains:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all domains from sk-nic.sk/subory/domains.txt';

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

        DB::delete('DELETE FROM domains');

        $data = file_get_contents('https://sk-nic.sk/subory/domains.txt');
        file_put_contents(storage_path('app/domains.txt'), $data);

        $handle = fopen(storage_path('app/domains.txt'), "rb");
        if (false === $handle) {
            exit("Failed to open stream to URL");
        }

        while (!feof($handle)) {
            $line = fgets($handle);

            if (substr($line, 0, 2) !== "--" && substr($line, 0, 7) !== 'domena;') {
                $values = str_getcsv($line, ';');
//                TODO: remove if statement below
                if ($values[0]) {
                    DB::insert('INSERT INTO domains (id, domain_name, registrar_id, registrant_id, domain_status, NS1, NS2, NS3, NS4, expiration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                        [Str::uuid(), $values[0], $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], $values[7], $values[8]]);
                }
            }
        }

        DB::commit();

        fclose($handle);

        return 0;
    }
}
