<?php
include_once "MySQLi_ResultWrapper.php";
 
try
{
    // connect to MySQL
    $db = MySQLiWrapper::getInstance(array('host', 'user', 'password', 'database'));
   
    // perform query
    $result = $db->runQuery('SELECT * FROM users');
   
    // traverse rows in result set
    foreach ($result as $user)
    {
        echo '<p>First Name: ' . $user->fname . ', Last Name : ' . $user->lname . '</p>';  
    }
   
    // reset result pointer
    $result->rewind();
   
    // display result pointer
    echo 'Result pointer : ' . $result->key();
   
    // display data in current row
    $user = $result->current();
    echo '<p>First Name: ' . $user->fname . ', Last Name : ' . $user->lname . '</p>';
   
    // move forward result pointer
    $result->next();
   
    // display result pointer
    echo 'Result pointer : ' . $result->key();
   
    // display data in current row
    $user = $result->current();
    echo '<p>First Name: ' . $user->fname . ', Last Name : ' . $user->lname . '</p>';
   
    // reset result pointer
    $result->rewind();
}
 
 
// catch exceptions
catch(Exception $e)
{
    echo $e->getMessage();
    exit();
}  
