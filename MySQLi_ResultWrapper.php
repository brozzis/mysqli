
class MySQLi_ResultWrapper extends MySQLi_Result implements Iterator, ArrayAccess, Countable

{

    private $_pointer = 0;

   

   // fetch row as an object

    public function fetchObject()

    {

        if (!$row = $this->fetch_object())

        {

            return NULL;

        }

        return $row;

    }

    

    // fetch row as an associative array

    public function fetchAssocArray()

    {

        if (!$row = $this->fetch_assoc())

        {

            return NULL;

        }

        return $row;

    }

   

    // fetch row as an enumerated array

    public function fetchNumArray()

    {

        if (!$row = $this->fetch_row())

        {

            return NULL;

        }

        return $row;

    }

   

    // fetch all rows

    public function fetchAll($type = MYSQLI_ASSOC)

    {

        if ($type !== MYSQLI_ASSOC AND $type !== MYSQLI_NUM AND $type !== MYSQLI_BOTH)

        {

            $type = MYSQLI_ASSOC;

        }

        if (!$rows = $this->fetch_all($type))

        {

            return NULL;

        }

        return $rows;  

    }

   

    // get definition information on fields

    public function fetchFieldsInfo()

    {

        if (!$fieldsInfo = $this->fetch_fields())

        {

            throw new Exception('No information available for table fields.');

        }

        return $fieldsInfo;

    }

   

    // get definition information on next field

    public function fetchFieldInfo()

    {

        if (!$fieldInfo = $this->fetch_field())

        {

            throw new Exception('No information available for current table field.');   

        }

        return $fieldInfo;

    }

   

    // move pointer in result set to specified offset

    public function movePointer($offset)

    {

        $offset = abs((int)$offset);

        $limit = $this->num_rows - 1;

        if ($limit <= 0 OR $offset > $limit)

        {

            return NULL;

        }

        unset($limit);

        return $this->data_seek($offset);

    }

    

    // count rows in result set (implementation required by 'count()' method in Countable interface)

    public function count()

    {

        return $this->num_rows;

    }

   

    // reset result set pointer (implementation required by 'rewind()' method in Iterator interface)

    public function rewind()

    {

        $this->_pointer = 0;

        $this->movePointer($this->_pointer);

        return $this; 

    }

   

    // get current row set in result set (implementation required by 'current()' method in Iterator interface)

    public function current()

    {

        if (!$this->valid())

        {

            throw new Exception('Unable to retrieve current row.');

        }

        $this->movePointer($this->_pointer);

        return $this->fetchObject();

    }

   

    // get current result set pointer (implementation required by 'key()' method in Iterator interface)

    public function key()

    {

        return $this->_pointer;

    }

   

    // move forward result set pointer (implementation required by 'next()' method in Iterator interface)

    public function next()

    {

        ++$this->_pointer;

        $this->movePointer($this->_pointer);

        return $this;

    }

   

    // determine if result set pointer is valid or not (implementation required by 'valid()' method in Iterator interface)

    public function valid()

    {

        return $this->_pointer < $this->num_rows;

    }

   

    // determine if the given offset exists (implementation required by 'offsetExists()' method in ArrayAccess interface)

    public function offsetExists($offset)

    {

        $this->movePointer($offset);

        $row = $this->fetchObject();

        return isset($row);

    }

   

    // get row according to given offset (implementation required by 'offsetExists()' method in ArrayAccess interface)

    public function offsetGet($offset)

    {

        $this->_pointer = abs((int)$offset);

        return $this->current();

    }

   

    // not implemented (required by 'offsetSet()' method in ArrayAccess interface)

    public function offsetSet($offset, $value){}

   

        // not implemented (required by 'offsetUnset()' method in ArrayAccess interface)

    public function offsetUnset($offset){}

   

    // free up result set

    public function __destruct()

    {

        $this->close();

    }

} 