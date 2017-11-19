<?php

namespace App\Lib\Contact;

final class Client
{
    /**
     * Hold the listening socket for this instance.
     *
     * @var Socket
     */
    private $socket;

    /**
     * Buffer to send messages to the client.
     *
     * @var array
     */
    private $message = [];

    /**
     * Buffer with data to process by the server.
     *
     * @var array
     */
    private $read = [];

    /**
     * Constructor for this class.
     *
     * @param $socket Socket
     */
    public function __construct($socket = null)
    {
        if (!$socket)
        {
            return;
        }

        $this->socket = $socket;
    }

    private function listen()
    {
        // ?
    }
}