<?php

namespace App\Lib\Contact;

final class ContactServer
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
    private $clients = [];

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
        }

        echo 'Server has stopped.'.PHP_EOL;
    }

    /*
     *  Create an instance of the server.
     *
     *  @return void
     */
    public static function Instance(string $host = null, int $port = 8000)
    {
        if (!static::$instance instanceof ContactServer)
        {
            if (is_null($host))
            {
                $host = $_SERVER['SERVER_NAME'];
            }

            static::$instance = new ContactServer($host, $port);
        }
    }

    /*
     *  Fire it up! This function creates the socket and binds it.
     *  It also makes sure the server socket is set to non-blocking.
     *
     *  @return bool
     */
    private function boot() : bool
    {
        // Inform user
        echo 'Starting Laravel Contact...'.PHP_EOL.
                '- Creating socket...'.PHP_EOL;

        // Create the socket.
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        // Check if the creation was successful.
        if (!$this->socket)
        {
            return false;
        }

        // Make it non-blocking.
        socket_set_nonblock($this->socket);

        // Bind the socket and check for errors.
        if(!socket_bind($this->socket, $this->settings['host'], $this->settings['port']))
        {
            return false;
        }

        // Inform user
        echo '- Opening socket...'.PHP_EOL;

        // Open the socket for incoming requests.
        if (!socket_listen($this->socket, 50000))
        {
            return false;
        }

        return true;
    }

    /*
     * Run the server and keep listening for incoming connections.
     *
     * @return void
     */
    private function run()
    {
        // Inform user
        echo 'Server started! Listening...'.PHP_EOL;

        // Start the loop.
        do
        {
            // Variable to hold the new client-socket.
            $newClient = null;

            // Create a new socket for the requesting client.
            if ($newClient = socket_accept($this->socket))
            {
                // Instantiate a new client object, push it and inject the newly created socket.
                $this->clients[] = new Client($newClient);

                echo '- A new client just connected.'.PHP_EOL;
            }

            // Does the server has anything to send? Did a client send new data? Write it!!!!



        } while (true);
    }

    /**
     * Handles new connections. Create new Client objects for requesting clients.
     *
     * @return bool
     */
    private function handleNewClients()
    {

    }
}