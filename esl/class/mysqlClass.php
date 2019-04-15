<?php


class mysqlClass
{
    public $db_username = 'fsuser';
    public $db_password = 'fsusrpaSssvc3swd';
    public $db_name = 'fs';
    public $db_host='172.10.10.2';



    function connectDB ()
    {
        $connection = mysqli_connect($this->db_host, $this->db_username, $this->db_password, $this->db_name);
        if (mysqli_connect_errno()) {
            return "Failed to connect to MySQL: " . mysqli_connect_error();
            die;
        }
        return $connection;
    }


    function sqlRequestAssoc($sql_request)
    {
        $connection = $this->connectDB();

        if ($result = mysqli_query($connection, $sql_request)) {
            $row = mysqli_fetch_assoc($result);
            print_r($row);

        }
        mysqli_free_result($result);
        mysqli_close($connection);
        return $row;
    }


    function sqlUpdate($sql_request)
    {
        $connection = $this->connectDB();

        $results = $connection->query($sql_request);
        if($results){
            $return = 'Success! record updated / deleted';
        }else{
            $return =  'Error : ('. $connection->errno .') '. $connection->error;
        }
        mysqli_close($connection);
        return $return;
    }
}