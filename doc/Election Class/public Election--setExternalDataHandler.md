## public Election::setExternalDataHandler

### Description    

```php
public $Election -> setExternalDataHandler ( Condorcet\DataManager\DataHandlerDrivers\DataHandlerDriverInterface driver )
```

Import and enable an external driver to store vote on very large election.    


##### **driver:** *Condorcet\DataManager\DataHandlerDrivers\DataHandlerDriverInterface*   
    



### Return value:   

*(bool)* True if success. Else throw an Exception.


---------------------------------------

### Related method(s)      

* [Election::removeExternalDataHandler](../Election Class/public Election--removeExternalDataHandler.md)    

---------------------------------------

### Examples and explanation

* **[[Manual - DataHandler]](https://github.com/julien-boudry/Condorcet/blob/master/examples/specifics_examples/use_large_election_external_database_drivers.php)**    
