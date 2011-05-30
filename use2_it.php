<?php

include_once "MySQLi_wrapper.php";

include_once "MySQLi_ResultWrapper.php";

try
{
    // connect to MySQL
    $db = MySQLiWrapper::getInstance(array('localhost:3306', 'ste', 'ste', 'squash'));
   
    // perform query
    $result = $db->runQuery('SELECT * FROM squash');
       
    // count the number of rows in result set
    echo 'Number of rows: ' . $result->count();
   
    // check if given offset exists
    if ($result->offsetExists(1))
    {
        echo 'Row exists!';
    }
    else
    {
        echo 'Row does not exists!';
    }
   
    // get a row according to a given offset
    $user = $result->offsetGet(1);
    echo '<p>First Name: ' . $user->p1 . ', Last Name : ' . $user->p2 . '</p>';
}
 
 
// catch exceptions
catch(Exception $e)
{
    echo $e->getMessage();
    exit();
}   

?>