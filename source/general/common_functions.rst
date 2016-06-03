##############################
Global Functions and Constants
##############################

CodeIgniter uses provides a few functions and variables that are globally defined, and are available to you at any point.
These do not require loading any additional libraries or helpers.

.. contents:: Page Contents
	:local:

================
Global Functions
================

Service Accessors
=================

.. php:function:: esc ( $data, $context='html' [, $encoding])

	:param   string|array   $data: The information to be escaped.
			:param   string   $context: The escaping context. Default is 'html'.
			:param   string   $encoding: The character encoding of the string.
			:returns: The escaped data.
			:rtype: string

			Escapes data for inclusion in web pages, to help prevent XSS attacks.
			This uses the Zend Escaper library to handle the actual filtering of the data.

			If $data is a string, then it simply escapes and returns it.
			If $data is an array, then it loops over it, escaping each 'value' of the key/value pairs.

			Valid context values: html, js, css, url, attr, raw, null

.. php:function:: helper( $filename )

	:param   string   $filename: The name of the helper file to load.

				Loads a helper file.

				For full details, see the :doc:`helpers` page.

.. php:function:: session( [$key] )

	:param string $key: The name of the session item to check for.
		:returns: An instance of the Session object if no $key,
				  the value found in the session for $key, or null.
		:rtype: mixed

		Provides a convenient way to access the session class and to retrieve a
		stored value. For more information, see the :doc:`Sessions </libraries/sessions>` page.

.. php:function:: timer( [$name] )

	:param string $name: The name of the benchmark point.
		:returns: The Timer instance
		:rtype: CodeIgniter\Debug\Timer

		A convenience method that provides quick access to the Timer class. You can pass in the name
		of a benchmark point as the only parameter. This will start timing from this point, or stop
		timing if a timer with this name is already running.
		::

	// Get an instance
	$timer = timer();

	// Set timer start and stop points
	timer('controller_loading');    // Will start the timer
	. . .
	timer('controller_loading');    // Will stop the running timer

.. php:function:: view ($name [, $data [, $options ]])

	:param   string   $name: The name of the file to load
		:param   array    $data: An array of key/value pairs to make available within the view.
		:param   array    $options: An array of options that will be passed to the rendering class.
		:returns: The output from the view.
		:rtype: string

		Grabs the current RenderableInterface-compatible class
		and tells it to render the specified view. Simply provides
		a convenience method that can be used in Controllers,
		libraries, and routed closures.

		Currently, only one option is available for use within the `$options` array, `saveData` which specifies
	that data will persistent between multiple calls to `view()` within the same request. By default, the
	data for that view is forgotten after displaying that single view file.

	The $option array is provided primarily to facilitate third-party integrations with
	libraries like Twig.

	Example::

		$data = ['user' => $user];

		echo view('user_profile', $data);

	For more details, see the :doc:`Views <views>` page.

Miscellaneous Functions
=======================

.. php:function:: csrf_token ()

	:returns: The name of the current CSRF token.
		:rtype: string

		Returns the name of the current CSRF token.

.. php:function:: csrf_hash ()

	:returns: The current value of the CSRF hash.
		:rtype: string

		Returns the current CSRF hash value.

.. php:function:: force_https ( $duration = 31536000 [, $request = null [, $response = null]] )

	:param  int  $duration: The number of seconds browsers should convert links to this resource to HTTPS.
			:param  RequestInterface $request: An instance of the current Request object.
			:param  ResponseInterface $response: An instance of the current Response object.

			Checks to see if the page is currently being accessed via HTTPS. If it is, then
			nothing happens. If it is not, then the user is redirected back to the current URI
			but through HTTPS. Will set the HTTP Strict Transport Security header, which instructs
			modern browsers to automatically modify any HTTP requests to HTTPS requests for the $duration.

.. php:function:: is_cli ()

	:returns: TRUE if the script is being executed from the command line or FALSE otherwise.
		:rtype: bool

.. php:function:: log_message ($level, $message [, array $context])

	:param   string   $level: The level of severity
	:param   string   $message: The message that is to be logged.
	:param   array    $context: An associative array of tags and their values that should be replaced in $message
	:returns: TRUE if was logged succesfully or FALSE if there was a problem logging it
	:rtype: bool

	Logs a message using the Log Handlers defined in **application/Config/Logger.php**.

	Level can be one of the following values: **emergency**, **alert**, **critical**, **error**, **warning**,
	**notice**, **info**, or **debug**.

	Context can be used to substitute values in the message string. For full details, see the
	:doc:`Logging Information <logging>` page.

.. php:function:: redirect( $uri[, ...$params ] )

	:param  string  $uri: The URI to redirect the user to.
		:param  mixed   $params: one or more additional parameters that can be used with the :meth:`RouteCollection::reverseRoute` method.

	Convenience method that works with the current global ``$request`` and
	``$router`` instances to redirect using named/reverse-routed routes
	to determine the URL to go to. If nothing is found, will treat
	as a traditional redirect and pass the string in, letting
	``$response->redirect()`` determine the correct method and code.

	If more control is needed, you must use ``$response->redirect()`` explicitly.

.. php:function:: remove_invisible_characters($str[, $url_encoded = TRUE])

	:param	string	$str: Input string
        :param	bool	$url_encoded: Whether to remove URL-encoded characters as well
        :returns:	Sanitized string
        :rtype:	string

        This function prevents inserting NULL characters between ASCII
        characters, like Java\\0script.

        Example::

            remove_invisible_characters('Java\\0script');
            // Returns: 'Javascript'

.. php:function:: route_to ( $method [, ...$params] )

	:param   string   $method: The named route alias, or name of the controller/method to match.
	:param   mixed   $params: One or more parameters to be passed to be matched in the route.

	Generates a relative URI for you based on either a named route alias, or a controller::method
	combination. Will take parameters into effect, if provided.

	For full details, see the :doc:`routing` page.

.. php:function:: service ( $name [, ...$params] )

	:param   string   $name: The name of the service to load
	:param   mixed    $params: One or more parameters to pass to the service method.
	:returns: An instance of the service class specified.
	:rtype: mixed

	Provides easy access to any of the :doc:`Services <../concepts/services>` defined in the system.

	Example::

		$logger = service('logger');
		$renderer = service('renderer', APPPATH.'views/');

.. php:function:: shared_service ( $name [, ...$params] )

	:param   string   $name: The name of the service to load
	:param   mixed    $params: One or more parameters to pass to the service method.
	:returns: An instance of the service class specified.
	:rtype: mixed

	Identical to the **service()** function described above, except that all calls to this
	function will share the same instance of the service, where **service** returns a new
	instance every time.


================
Global Constants
================

The following constants are always available anywhere within your application.

Core Constants
--------------

.. php:const:: APPPATH

	The path to the **application** directory.

.. php:const:: BASEPATH

	The path to the **system** directory.

.. php:const:: FCPATH

	The path to the directory that holds the front controller.

.. php:const:: SELF

	The path to the front controller, **index.php**.

.. php:const:: WRITEPATH

	The path to the **writable** directory.


Time Constants
--------------

.. php:const:: SECOND

	Equals 1.

.. php:const:: MINUTE

	Equals 60.

.. php:const:: HOUR

	Equals 3600.

.. php:const:: DAY

	Equals 86400.

.. php:const:: WEEK

	Equals 604800.

.. php:const:: MONTH

	Equals 2592000.

.. php:const:: YEAR

	Equals 31536000.
