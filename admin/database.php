<?php

  class Database
{
  private static $dbHost = "host";
  private static $dbName = "burger_code";
  private static $dbUsername = "username";
  private static $dbUserpassword = "pwd";
  private static $connection = null;
  public static function connect()
  {
    if(self::$connection == null){
      try
      {
        self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName , self::$dbUsername, self::$dbUserpassword);
      }
      catch(PDOException $e)
      {
        die($e->getmessage());
      }
      return self::$connection;
    }    
  }
  public static function disconnect()
  {
      self::$connection = null;
  } 
}

?>

<?php

