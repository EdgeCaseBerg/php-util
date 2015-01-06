Database
========================================================================

Example Usage:

	
	//Retrieve database instance
	$db = Database::instance();
	
	//Using any child type of Entity (core/Entity.class.php)
	$g = new Entity();
	$g->user_id = 1;
	$g->name = "Test";

	//Call insert to create, false or your object back with new id defined
	$db->insert($g);

	$g->name = "Test Updated";
	//Call update to update Entity, false or your object back
	$db->update($g);

	//Call delete with an Entity, T or F for deleted successfully or not
	$db->delete($g);

	//To select, set id of empty entity and observe
	$g->id = 13;
	$g2 = $db->get($g);

	//Get all goals
	$goals = $db->all($g);

	//Select goal types using custom query
	$s = $db->custom("SELECT * FROM example_table");

	//Select custom query using parameters, returns array of objects
	$s = $db->custom("SELECT * FROM example_table where id = :id", array(':id' => 1));

	/There's a shortcut for the above though, use where
	$s = $db->where(new Entity(), 'id', 1);

	//Insert,update,delete using custom, returns true or false
	$db->custom("INSERT INTO example_table (id, name) VALUES (:id,:name)", array(':id' => -1, ':name' => 'test'));


The database class within the bootstrap folder is a simple PDO wrapper 
that allows for basic CRUD operations on any Entity. It also provides a 
few simple operations to retrieve Entities, see below for a full list:


### Database Functions

**all**

Parameters: `Entity`  
Returns: Array of the given Entity's type. 

------------------------------------------------------------------------

**get**

Parameters: `Entity` with `id` field set to desire item  
Returns: Desired Entity or false if it does not exist

------------------------------------------------------------------------

static::**instance**

Parameters:None 
Returns: instance of database to use

------------------------------------------------------------------------

**insert**

Parameters: `Entity`  
Returns: Desired Entity or false if failure to insert occurs

------------------------------------------------------------------------

**update**

Parameters: `Entity` with `id` field set
Returns: Desired Entity or false if it does not update

------------------------------------------------------------------------

**delete**

Parameters: `Entity` with `id` field set  
Returns: True if deletion is successful, false otherwise

------------------------------------------------------------------------

**where**

Parameters: `Entity`, `fieldName`, `fieldValue`  
Returns: Array of Entities matching where Entity table has fieldName = fieldValue

------------------------------------------------------------------------

**custom** 

Parameters: query with `:key`-ed parameters, array with key => values 
Returns: array of objects if query is a select statement, true or false otherwise.
