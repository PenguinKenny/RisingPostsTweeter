<?php
class Database
{
    private $host = "";
    private $name = "";
    private $username = "";
    private $password = "";
    private $table = "`posts`";

    public function isNewTweet($id)
    {
        $connection = new mysqli($this->host, $this->username, $this->password, $this->name);
        if ($connection->connect_error){
            die ("Connection failed: ".$connection->connect_error);
        }

        $sql = "SELECT * FROM ".$this->table." WHERE `id`='".$id."';";
        $result = $connection->query($sql);
        if ($result->num_rows > 0)
        {
            echo $id;
            return false;
        }
        else
        {
            echo $id;
            return true;
        }
    }

    public function tweetPosted($id)
    {
        $connection = new mysqli($this->host, $this->username, $this->password, $this->name);
        if ($connection->connect_error){
            die ("Connection failed: ".$connection->connect_error);
        }

        $sql = "INSERT INTO ".$this->table."(`id`) VALUES (".$id.")";
        $result = $connection->query($sql);
    }
}
?>