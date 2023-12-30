<?php
// https://www.youtube.com/watch?v=X51KOJKrofU
// TOOD: replace server w/ proper VM IP

class Database {
    public function __construct(
        private string $server,
        private string $user,
        private string $password,
        private string $name
    ) {
    }

    /**
     * Connect to the database.
     * Returns the connection object.
     */
    public function getConnection(): PDO {
        $conn_str = "mysql:host={$this->server};dbname={$this->name};charset=utf8";

        return new PDO($conn_str, $this->user, $this->password, [
            // Do not convert any values from what they are (e.g. keep an int from the db as an int)
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]);
    }
}
?>