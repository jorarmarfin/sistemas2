<?php

namespace App\Console\Commands;

use App\Mail\TestEmail;
use App\Traits\SendEmailTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestCommand extends Command
{
    use SendEmailTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $response = $this->sendBrevoEmail(
            (object)[
                'correo' => 'luis.mayta@drinux.com',
                'nombres' => 'Luis',
                'apellidos' => 'Mayta'
            ],
            1
        );
        $this->info($response);

        return 0;
    }
}
