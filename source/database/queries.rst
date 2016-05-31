#######
Queries
#######

************
Query Basics
************

Regular Queries
===============

To submit a query, use the **query** function::

	$db->query('YOUR QUERY HERE');

The query() function returns a database result **object** when "read"
type queries are run, which you can use to :doc:`show your
results <results>`. When "write" type queries are run it simply
returns TRUE or FALSE depending on success or failure. When retrieving
data you will typically assign the query to your own variable, like
this::

	$query = $db->query('YOUR QUERY HERE');

Simplified Queries
==================

The **simpleQuery** method is a simplified version of the
$db->query() method. It DOES
NOT return a database result set, nor does it set the query timer, or
compile bind data, or store your query for debugging. It simply lets you
submit a query. Most users will rarely use this function.

It returns whatever the database drivers' "execute" function returns.
That typically is TRUE/FALSE on success or failure for write type queries
such as INSERT, DELETE or UPDATE statements (which is what it really
should be used for) and a resource/object on success for queries with
fetchable results.

::

	if ($db->simpleQuery('YOUR QUERY'))
	{
		echo "Success!";
	}
	else
	{
		echo "Query failed!";
	}

.. note:: PostgreSQL's ``pg_exec()`` function (for example) always
	returns a resource on success, even for write type queries.
	So take that in mind if you're looking for a boolean value.

***************************************
Working with Database prefixes manually
***************************************

If you have configured a database prefix and would like to prepend it to
a table name for use in a native SQL query for example, then you can use
the following::

	$db->prefixTable('tablename'); // outputs prefix_tablename


If for any reason you would like to change the prefix programatically
without needing to create a new connection, you can use this method::

	$db->setPrefix('newprefix');
	$db->prefixTable('tablename'); // outputs newprefix_tablename


**********************
Protecting identifiers
**********************

In many databases it is advisable to protect table and field names - for
example with backticks in MySQL. **Query Builder queries are
automatically protected**, however if you need to manually protect an
identifier you can use::

	$db->protectIdentifiers('table_name');

.. important:: Although the Query Builder will try its best to properly
	quote any field and table names that you feed it, note that it
	is NOT designed to work with arbitrary user input. DO NOT feed it
	with unsanitized user data.

This function will also add a table prefix to your table, assuming you
have a prefix specified in your database config file. To enable the
prefixing set TRUE (boolean) via the second parameter::

	$db->protectIdentifiers('table_name', TRUE);


****************
Escaping Queries
****************

It's a very good security practice to escape your data before submitting
it into your database. CodeIgniter has three methods that help you do
this:

#. **$db->escape()** This function determines the data type so
   that it can escape only string data. It also automatically adds
   single quotes around the data so you don't have to:
   ::

	$sql = "INSERT INTO table (title) VALUES(".$db->escape($title).")";

#. **$db->escapeString()** This function escapes the data passed to
   it, regardless of type. Most of the time you'll use the above
   function rather than this one. Use the function like this:
   ::

	$sql = "INSERT INTO table (title) VALUES('".$db->escapeString($title)."')";

#. **$db->escapeLikeString()** This method should be used when
   strings are to be used in LIKE conditions so that LIKE wildcards
   ('%', '\_') in the string are also properly escaped.

::

        $search = '20% raise'; 
        $sql = "SELECT id FROM table WHERE column LIKE '%" .
            $db->escapeLikeString($search)."%' ESCAPE '!'";

.. important:: The ``escapeLikeString()`` method uses '!' (exclamation mark)
	to escape special characters for *LIKE* conditions. Because this
	method escapes partial strings that you would wrap in quotes
	yourself, it cannot automatically add the ``ESCAPE '!'``
	condition for you, and so you'll have to manually do that.


**************
Query Bindings
**************

Bindings enable you to simplify your query syntax by letting the system
put the queries together for you. Consider the following example::

	$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
	$db->query($sql, [3, 'live', 'Rick']);

The question marks in the query are automatically replaced with the
values in the array in the second parameter of the query function.

Binding also work with arrays, which will be transformed to IN sets::

	$sql = "SELECT * FROM some_table WHERE id IN ? AND status = ? AND author = ?";
	$db->query($sql, array(array(3, 6), 'live', 'Rick'));

The resulting query will be::

	SELECT * FROM some_table WHERE id IN (3,6) AND status = 'live' AND author = 'Rick'

The secondary benefit of using binds is that the values are
automatically escaped, producing safer queries. You don't have to
remember to manually escape data; the engine does it automatically for
you.

Named Bindings
==============

Instead of using the question mark to mark the location of the bound values,
you can name the bindings, allowing the keys of the values passed in to match
placeholders in the query::

	$sql = "SELECT * FROM some_table WHERE id = :id AND status = :status AND author = :name";
	$db->query($sql, ['id'     => 3,
					  'status' => 'live',
					  'name'   => 'Rick']);

***************
Handling Errors
***************

**$db->error();**

If you need to get the last error that has occured, the error() method
will return an array containing its code and message. Here's a quick
example::

	if ( ! $db->simpleQuery('SELECT `example_field` FROM `example_table`'))
	{
		$error = $db->error(); // Has keys 'code' and 'message'
	}


**************************
Working with Query Objects
**************************

Internally, all queries are processed and stored as instances of
\CodeIgniter\Database\Query. This class is responsible for binding
the parameters, otherwise preparing the query, and storing performance
data about its query.

**getQueries()**

You can retrieve all Query objects from the database connection with the
getQueries() method. This has no parameters and returns an array of
all of the queries that have ran::

	$queries = $db->getQueries();

.. note:: If the saveQueries setting in the database configuraiton is set
	to false, this and the following two methods, will not return any results.

**getQueryCount()**

Returns the total number of queries that have been ran on this connection
during this request::

	$count = $db->getQueryCount();

**getLastQuery()**

When you just need to retrieve the last Query object, use the
getLastQuery() method::

	$query = $db->getLastQuery();
	echo (string)$query;

The Query Class
===============

Each query object stores several pieces of information about the query itself.
This is used, in part, by the Timeline feature, but is available for your use
as well.

**getQuery()**

Returns the final query, after all processing has happened. This is the exact
query that was sent to the database::

	$sql = $query->getQuery();

This same value can be retrieved by casting the Query object to a string::

	$sql = (string)$query;

**getOriginalQuery()**

Returns the raw SQL that was passed into the object. This will not have any
binds in it, or prefixes swapped out, etc::

	$sql = $query->getOriginalQuery();

**hasError()**

If an error was encountered during the execution of this query, this method
will return true::

	if ($query->hasError())
	{
		echo 'Code: '. $query->getErrorCode();
		echo 'Error: '. $query->getErrorMessage();
	}

**isWriteType()**

Returns true if the query was determined to be a write-type query (i.e.
INSERT, UPDATE, DELETE, etc)::

	if ($query->isWriteType())
	{
		... do something
	}

**swapPrefix()**

Replaces one table prefix with another value in the final SQL. The first
parameter is the original prefix that you want replaced, and the second
parameter is the value you want it replaced with::

	$sql = $query->swapPrefix('ci3_', 'ci4_');

**getStartTime()**

Gets the time the query was executed in seconds with microseconds::

	$microtime = $query->getStartTime();

**getDuration()**

Returns a float with the duration of the query in seconds with microseconds::

	$microtime = $query->getDuration();
