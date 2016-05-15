TODO: rewrite for CodeIgniter4

#############################
Upgrading from 3.x to 4.x
#############################

Before performing an update you should take your site offline by
replacing the index.php file with a static one.

Step 1: Update your CodeIgniter files
=====================================

Replace all files and directories in your *system/* directory.

.. note:: If you have any custom developed files in these directories,
	please make copies of them first.

Step 2: Change database connection handling
===========================================

"Loading" a database, whether by using the *config/autoload.php* settings
or manually via calling ``$this->load->database()`` or the less-known
``DB()`` function, will now throw a ``RuntimeException`` in case of a
failure.

In addition, being unable to set the configured character set is now also
considered a connection failure.

.. note:: This has been the case for most database drivers in the in the
	past as well (i.e. all but the 'mysql', 'mysqli' and 'postgre'
	drivers).

What this means is that if you're unable to connect to a database, or
have an erroneous character set configured, CodeIgniter will no longer
fail silently, but will throw an exception instead.

You may choose to explicitly catch it (and for that purpose you can't use
*config/autoload.php* to load the :doc:`Database Class <../database/index>`)
::

	try
	{
		$this->load->database();
	}
	catch (RuntimeException $e)
	{
		// Handle the failure
	}

Or you may leave it to CodeIgniter's default exception handler, which would
log the error message and display an error screen if you're running in
development mode.

Remove db_set_charset() calls
-----------------------------

With the above-mentioned changes, the purpose of the ``db_set_charset()``
method would now only be to change the connection character set at runtime.
That doesn't make sense and that's the reason why most database drivers
don't support it at all.
Thus, ``db_set_charset()`` is no longer necessary and is removed.

Step 3: Check logic related to URI parsing of CLI requests
==========================================================

When running a CodeIgniter application from the CLI, the
:doc:`URI Library <../libraries/uri>` will now ignore the
``$config['url_suffix']`` and ``$config['permitted_uri_chars']``
configuration settings.

These two options don't make sense under the command line (which is why
this change was made) and therefore you shouldn't be affected by this, but
if you've relied on them for some reason, you'd probably have to make some
changes to your code.

Step 4: Check Cache Library configurations for Redis, Memcache(d)
=================================================================

The new improvements for the 'redis' and 'memcached' drivers of the
:doc:`Cache Library <../libraries/caching>` may require some small
adjustments to your configuration values ...

Redis
-----

If you're using the 'redis' driver with a UNIX socket connection, you'll
have to move the socket path from ``$config['socket']`` to
``$config['host']`` instead.

The ``$config['socket_type']`` option is also removed, although that won't
affect your application - it will be ignored and the connection type will
be determined by the format used for ``$config['host']`` instead.

Memcache(d)
-----------

The 'memcached' will now ignore configurations that don't specify a ``host``
value (previously, it just set the host to the default '127.0.0.1').

Therefore, if you've added a configuration that only sets e.g. a ``port``,
you will now have to explicitly set the ``host`` to '127.0.0.1' as well.

Step 5: Check usage of doctype() HTML helper
============================================

The :doc:`HTML Helper <../helpers/html_helper>` function
:php:func:`doctype()` used to default to 'xhtml1-strict' (XHTML 1.0 Strict)
when no document type was specified. That default value is now changed to
'html5', which obviously stands for the modern HTML 5 standard.

Nothing should be really broken by this change, but if your application
relies on the default value, you should double-check it and either
explicitly set the desired format, or adapt your front-end to use proper
HTML 5 formatting.