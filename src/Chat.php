<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

function isJSON($string){
	return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}
class Chat implements MessageComponentInterface {
    protected $clients;
	private $nicknames;
	
    public function __construct() {
        $this->clients = new \SplObjectStorage;
		$this->nicknames = [];
    }
	
    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $conn, $msg) {
        $numRecv = count($this->clients) - 1;
		if(isJSON($msg))
		{
			$message = json_decode($msg);
			$output = "<div class='d-flex w-100 justify-content-between'><h5 class='mb-1'>".$message->nick."</h5></div><p class='mb-1'>".htmlspecialchars($message->message)."</p>";
			echo sprintf('User %d sending message "%s" to %d other connection%s' . "\n", $message->nick, $message->message, $numRecv, $numRecv == 1 ? '' : 's');

			foreach ($this->clients as $client) {
				$client->send($output);          
			}
		}
		else
		{
			$this->nicknames[$conn->resourceId] = $msg;
			foreach ($this->clients as $client) {
				if($conn !== $client) $client->send("User <b>". $this->nicknames[$conn->resourceId]  ."</b> joined");         
			}
		}
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        foreach ($this->clients as $client) {
            if($conn !== $client) $client->send("<b>".$this->nicknames[$conn->resourceId]. "</b> disconnected");         
		}
		unset($this->nicknames[$conn->resourceId]);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}