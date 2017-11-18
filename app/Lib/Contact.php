<?php

namespace App\Lib;

final class Contact
{
    /*
     *  @var $instance
     *
     *  Instance of this class.
     */
    private static $instance;

    /*
     *  @collection $settings
     *
     *  Settings for the connection.
     */
    private $settings;

    /*
     *  This property contains the listening socket.
     */
    private $socket;

    /*
     *  This array contains all connected clients.
     */
    private static $clients = [];

    private function __construct(string $host, int $port)
    {
        // Set preferences.
        $this->settings = [
            'host' => $host,
            'port' => $port
        ];

        // Boot the server.
        if ($this->boot())
        {
            // Run it!
            $this->run();
        }
        else
        {
            echo socket_last_error($this->socket);
            dd();
        }
    }

    /*
     *  Create an instance of the server.
     *
     *  @return void
     */
    public static function Instance(string $host = null, int $port = 8000)
    {
        if (!static::$instance instanceof Contact)
        {
            if (is_null($host))
            {
                $host = $_SERVER['SERVER_NAME'];
            }

            static::$instance = new Contact($host, $port);
        }
    }

    /*
     *  Fire it up! This function creates the socket and binds it.
     *
     *  @return bool
     */
    private function boot() : bool
    {
        // Create the socket.
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        // Check if the creation was successful.
        if (!$this->socket)
        {
            return false;
        }

        // Bind the socket and check for errors.
        if(!socket_bind($this->socket, $this->settings['host'], $this->settings['port']))
        {
            return false;
        }

        return true;
    }

    private function run()
    {

    }
}