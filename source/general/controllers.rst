###########
Controllers
###########

Controllers are the heart of your application, as they determine how HTTP requests should be handled.

.. contents:: Page Contents

What is a Controller?
=====================

A Controller is simply a class file that is named in a way that it can be associated with a URI.

Consider this URI::

	example.com/index.php/blog/

In the above example, CodeIgniter would attempt to find a controller named Blog.php and load it.

**When a controller's name matches the first segment of a URI, it will be loaded.**

Let's try it: Hello World!
==========================

Let's create a simple controller so you can see it in action. Using your text editor, create a file called Blog.php,
and put the following code in it::

	<?php
	class Blog extends \CodeIgniter\Controller
	{
		public function index()
		{
			echo 'Hellow World!';
		}
	}

Then save the file to your **/application/Controllers/** directory.

.. important:: The file must be called 'Blog.php', with a capital 'B'.

Now visit your site using a URL similar to this::

	example.com/index.php/blog

If you did it right, you should see::

	Hello World!

.. important:: Class names must start with an uppercase letter.

This is valid::

	<?php
	class Blog extends CodeIgniter\Controller {

	}

This is **not** valid::

	<?php
	class blog extends CodeIgniter\Controller {

	}

Also, always make sure your controller extends the parent controller
class so that it can inherit all its methods.

Methods
=======

In the above example the method name is ``index()``. The "index" method
is always loaded by default if the **second segment** of the URI is
empty. Another way to show your "Hello World" message would be this::

	example.com/index.php/blog/index/

**The second segment of the URI determines which method in the
controller gets called.**

Let's try it. Add a new method to your controller::

	<?php
	class Blog extends CodeIgniter\Controller {

		public function index()
		{
			echo 'Hello World!';
		}

		public function comments()
		{
			echo 'Look at this!';
		}
	}

Now load the following URL to see the comment method::

	example.com/index.php/blog/comments/

You should see your new message.

Passing URI Segments to your methods
====================================

If your URI contains more than two segments they will be passed to your
method as parameters.

For example, let's say you have a URI like this::

	example.com/index.php/products/shoes/sandals/123

Your method will be passed URI segments 3 and 4 ("sandals" and "123")::

	<?php
	class Products extends CodeIgniter\Controller {

		public function shoes($sandals, $id)
		{
			echo $sandals;
			echo $id;
		}
	}

.. important:: If you are using the :doc:`URI Routing <routing>`
	feature, the segments passed to your method will be the re-routed
	ones.

Defining a Default Controller
=============================

CodeIgniter can be told to load a default controller when a URI is not
present, as will be the case when only your site root URL is requested.
To specify a default controller, open your **application/config/routes.php**
file and set this variable::

	$routes->setDefaultController('Blog');

Where 'Blog' is the name of the controller class you want used. If you now
load your main index.php file without specifying any URI segments you'll
see your "Hello World" message by default.

For more information, please refer to the "Routes Configuration Options" section of the
:doc:`URI Routing <routing>` documentation.

Remapping Method Calls
======================

As noted above, the second segment of the URI typically determines which
method in the controller gets called. CodeIgniter permits you to override
this behavior through the use of the ``_remap()`` method::

	public function _remap()
	{
		// Some code here...
	}

.. important:: If your controller contains a method named _remap(),
	it will **always** get called regardless of what your URI contains. It
	overrides the normal behavior in which the URI determines which method
	is called, allowing you to define your own method routing rules.

The overridden method call (typically the second segment of the URI) will
be passed as a parameter to the ``_remap()`` method::

	public function _remap($method)
	{
		if ($method === 'some_method')
		{
			$this->$method();
		}
		else
		{
			$this->default_method();
		}
	}

Any extra segments after the method name are passed into ``_remap()``. These parameters can be passed to the method
to emulate CodeIgniter's default behavior.

Example::

	public function _remap($method, ...$params)
	{
		$method = 'process_'.$method;
		if (method_exists($this, $method))
		{
			return $this->$method(...$params);
		}
		show_404();
	}

Private methods
===============

In some cases you may want certain methods hidden from public access.
In order to achieve this, simply declare the method as being private
or protected and it will not be served via a URL request. For example,
if you were to have a method like this::

	protected function utility()
	{
		// some code
	}

Trying to access it via the URL, like this, will not work::

	example.com/index.php/blog/utility/


Organizing Your Controllers into Sub-directories
================================================

If you are building a large application you might want to hierarchically
organize or structure your controllers into sub-directories. CodeIgniter
permits you to do this.

Simply create sub-directories under the main *application/Controllers/*
one and place your controller classes within them.

.. note:: When using this feature the first segment of your URI must
	specify the folder. For example, let's say you have a controller located
	here::

		application/controllers/products/Shoes.php

	To call the above controller your URI will look something like this::

		example.com/index.php/products/shoes/show/123

Each of your sub-directories may contain a default controller which will be
called if the URL contains *only* the sub-directory. Simply put a controller
in there that matches the name of your 'default_controller' as specified in
your *application/Config/Routes.php* file.

CodeIgniter also permits you to remap your URIs using its :doc:`URI Routing <routing>` feature.

Class Constructors
==================

If you intend to use a constructor in any of your Controllers, you
**MUST** place the following line of code in it::

	parent::__construct(...$params);

The reason this line is necessary is because your local constructor will
be overriding the one in the parent controller class so we need to
manually call it.

Example::

	<?php
	class Blog extends CodeIgniter\Controller
	{
		public function __construct(...$params)
		{
			parent::__construct(...$params);

			// Your own constructor code
		}
	}

Constructors are useful if you need to set some default values, or run a
default process when your class is instantiated. Constructors can't
return a value, but they can do some default work.

Included Properties
===================

Every controller you create should extend ``CodeIgniter\Controller`` class.
This class provides several features that are available to all of your controllers.

Request Object
--------------
The application's main :doc:`Request Instance <../libraries/request>` is always available
as a class property, ``$this->request``.

Response Object
---------------
The application's main :doc:`Response Instance <../libraries/response>` is always available
as a class property, ``$this->response``.

Logger Object
-------------
An instance of the :doc:`Logger <../general/logging>` class is available as a class property,
``$this->logger``.

forceHTTPS
----------
A convenience method for forcing a method to be accessed via HTTPS is available within all
controllers::

	if (! $this->request->isSecure())
	{
		$this->forceHTTPS();
	}

By default, and in modern browsers that support the HTTP Strict Transport Security header, this
call should force the browser to convert non-HTTPS calls to HTTPS calls for one year. You can
modify this by passing the duration (in seconds) as the first parameter::

	if (! $this->request->isSecure())
	{
		$this->forceHTTPS(31536000);    // one year
	}

helpers
-------

You can define an array of helper files as a class property. Whenever the controller is loaded,
these helper files will be automatically loaded into memory so that you can use their methods anywhere
inside the controller::

	class MyController extends \CodeIgniter\Controller
	{
		protected $helpers = ['url', 'form'];
	}

That's it!
==========

That, in a nutshell, is all there is to know about controllers.