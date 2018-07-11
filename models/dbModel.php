<?php
/**
 * Class dbModel
 *
 * @package     Student_Management_System
 * @author      Anuradha Fernando <aji81111@gmail.com>
 * @copyright   Copyright (c) 2018
 */
class dbModel {

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $pwd;

    /**
     * @var string
     */
    private $db;

    /**
     * @var SimpleXMLElement
     */
    private $loadXml;

    /**
     * @var string
     */
    private $conn;


    /**
     * Database constructor.
     */
    public function __construct()
    {
        if(!$this->loadXml)
        {
            if(file_exists('config/config.xml'))
            {
                $this->loadXml = simplexml_load_file('config/config.xml', 'SimpleXMLElement');
            } else {
                exit('Failed to load configurations. Unable to find the config XML');
            }
        }

        $this->host = (String)$this->loadXml->host;
        $this->user = (String)$this->loadXml->username;
        $this->pwd   = (String)$this->loadXml->password;
        $this->db   = (String)$this->loadXml->dbname;

        $this->conn = $this->openDb();
    }

    /**
     * Open mysql connection
     * @return bool|mysqli
     */
    public function openDb()
    {
        /* establish link */
        try {
            $dbconn = new mysqli($this->host, $this->user, $this->pwd, $this->db);

            if (mysqli_connect_errno()){
                exit("Unable to connect to MySQL due to : " . mysqli_connect_error());
            }
        } catch (Exception $exception) {
            exit("Could not connect to the database. Please check the database connection and try again");
        }

        $dbconn->autocommit(TRUE);

        return $dbconn;
    }

    /**
     * Execute Query
     * @param $query
     * @return bool|mysqli_result
     */
    public function execQuery($query){
        return $this->conn->query($query);
    }

    /**
     * Fetch results from database
     * @param $query
     * @return array|string
     */
    public function fetchResult($query){
        $result = $this->execQuery($query);

        if ($result->num_rows > 0) {
            //output data of each row
            $dataArray = array();
            while($row = $result->fetch_assoc()) {
                $dataArray[] = $row;
            }

            return $dataArray;
        } else {
            return "No records found";
        }
    }

    /**
     * Get last inserted Student Id
     * @return mixed
     */
    public function insertId(){
        return $this->conn->insert_id;
    }

    /**
     * Class destructor
     * Closes the connection to mysql if present.
     */
    public function __destruct()
    {
        $this->conn->close();
    }
}