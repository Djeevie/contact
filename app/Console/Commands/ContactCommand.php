<?php

namespace App\Console\Commands;

use App\Lib\Contact;
use Illuminate\Console\Command;

class ContactCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the Contact socket server.';

    /**
     *  Holds the Contact instance.
     *
     *  @var ContactCommand instance
     */
    protected $contact;

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
        $host = 'localhost';

        $this->contact = Contact::Instance($host);
    }
}
