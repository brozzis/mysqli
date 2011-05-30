<?php

 

 

try

{

    // connect to MySQL

    $db = MySQLiWrapper::getInstance(array('host', 'user', 'password', 'database'));

   

    // perform query

    $result = $db->runQuery('SELECT * FROM users');

       

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

    echo '<p>First Name: ' . $user->fname . ', Last Name : ' . $user->lname . '</p>';

}

 

 

// catch exceptions

catch(Exception $e)

{

    echo $e->getMessage();

    exit();

}   