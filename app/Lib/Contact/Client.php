<?php

namespace App\Lib\Contact;

class Client
{
    /**
     * Hold the listening socket for this instance.
     *
     * @var Socket
     */
    protected $socket;

    /**
     * Buffer to send messages to the client.
     *
     * @var array
     */
    protected $message = [];

    /**
     * Buffer with data to process by the server.
     *
     * @var array
     */
    protected $read = [];

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

    /**
     * Listen for incoming streams of data.
     *
     * @return void
     */
    public function Interact(array $dataToSend, $callback)
    {
        foreach ($dataToSend as $data)
        {
            echo $data.PHP_EOL;
        }

        $dataToProcess = 'Hello world!';

        if (is_callable($callback))
        {
            call_user_func($callback, $dataToProcess);
        }
        else
        {
            echo 'NOT CALLABLE'.PHP_EOL;
        }
    }

    /**
     * Listen for incoming streams of data.
     *
     * @return void
     */
    protected function read()
    {
        // ?
    }

    /**
     * Listen for incoming streams of data.
     *
     * @return void
     */
    protected function write()
    {
        // ?
    }
}