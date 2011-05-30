class MySQLiWrapper extends MySQLi
{
   
   private static $_instance = NULL;
 
 
   // return Singleton instance of MySQL class
   public static function getInstance(array $config = array())
   {
       if (self::$_instance === NULL)
       {
          self::$_instance = new self($config);
       }
       return self::$_instance;
   }
  
   // private constructor
   private function __construct(array $config)
   {
        if (count($config) < 4)
        {
            throw new Exception('Invalid number of connection parameters');  
        }
       list($host, $user, $password, $database) = $config;
       parent::__construct($host, $user, $password, $database);
        if ($this->connect_error)
        {
            throw new Exception('Error connecting to MySQL : ' . $this->connect_errno . ' ' . $this->connect_error);
        }
   }
 
 
    // prevent cloning class instance
    private function __clone(){}
   
    // perform query
    public function runQuery($query)
    {
        if (is_string($query) AND !empty($query))
        {
            if ((!$this->real_query($query)))
            {
                throw new Exception('Error performing query ' . $query . ' - Error message : ' . $this->error);
            }
            return new MySQLi_ResultWrapper($this);
        }
    }
   
    // get insertion ID
    public function getInsertID()
    {
        return $this->insert_id;
    }
   
    // close database connection
    public function __destruct()
    {
        $this->close();
    }
} 
