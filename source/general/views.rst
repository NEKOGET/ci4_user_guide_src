#####
Views
#####

A view is simply a web page, or a page fragment, like a header, footer, sidebar, etc. In fact,
views can flexibly be embedded within other views (within other views, etc.) if you need
this type of hierarchy.

Views are never called directly, they must be loaded by a controller. Remember that in an MVC framework,
the Controller acts as the traffic cop, so it is responsible for fetching a particular view. If you have
not read the :doc:`Controllers <controllers>` page, you should do so before continuing.

Using the example controller you created in the controller page, let’s add a view to it.

Creating a View
===============

Using your text editor, create a file called ``BlogView.php`` and put this in it::

	<html>
	<head>
        <title>My Blog</title>
	</head>
	<body>
        <h1>Welcome to my Blog!</h1>
	</body>
	</html>

Then save the file in your **application/Views** directory.

Loading a View
==============

To load a particular view file you will use the following function::

	view('name');

Where _name_ is the name of your view file.

.. important:: The .php file extension does not need to be specified, but all views are expected to end with the .php extension.

Now, open the controller file you made earlier called ``Blog.php``, and replace the echo statement with the view function::

	class Blog extends \CodeIgniter\Controller
	{
		public function index()
		{
			echo view('BlogView');
		}
	}

If you visit your site using the URL you did earlier you should see your new view. The URL was similar to this::

	example.com/index.php/blog/

Loading Multiple Views
======================

CodeIgniter will intelligently handle multiple calls to ``view()`` from within a controller. If more than one
call happens they will be appended together. For example, you may wish to have a header view, a menu view, a
content view, and a footer view. That might look something like this::

	class Page extends \CodeIgniter\Controller
	{
		public function index()
		{
			$data = [
				'page_title' = 'Your title'
			];

			echo view('header');
			echo view('menu');
			echo view('content', $data);
			echo view('footer');
		}
	}

In the example above, we are using "dynamically added data", which you will see below.

Storing Views within Sub-directories
====================================

Your view files can also be stored within sub-directories if you prefer that type of organization.
When doing so you will need to include the directory name loading the view.  Example::

	echo view('directory_name/file_name');

Namespaced Views
================

You can store views under a **View** directory that is namespaced, and load that view as if it was namespaced. While
PHP does not support loading non-class files from a namespace, CodeIgniter provides this feature to make it possible
to package your views together in a module-like fashion for easy re-use or distribution.

If you have ``Blog`` directory that has a PSR-4 mapping setup in the :doc:`Autoloader </concepts/autoloader>` living
under the namespace ``Example\Blog``, you could retrieve view files as if they were namespaced also. Following this
example, you could load the **BlogView** file from **/blog/views** by prepending the namespace to the view name::

    echo view('Example\Blog\BlogView');

Caching Views
=============

You can cache a view with the ``view`` command by passing a ``cache`` option with the number of seconds to cache
the view for, in the third parameter::

    // Cache the view for 60 seconds
    echo view('file_name', $data, ['cache' => 60]);

By default, the view will be cached using the same name as the view file itself. You can customize this by passing
along ``cache_name`` and the cache ID you wish to use::

    // Cache the view for 60 seconds
    echo view('file_name', $data, ['cache' => 60, 'cache_name' => 'my_cached_view']);

Adding Dynamic Data to the View
===============================

Data is passed from the controller to the view by way of an array in the second parameter of the view function.
Here's an example::

	$data = [
		'title' => 'My title',
		'heading' => 'My Heading',
		'message' => 'My Message'
	];

	echo view('blogview', $data);

Let's try it with your controller file. Open it and add this code::

	class Blog extends \CodeIgniter\Controller
	{
		public function index()
		{
			$data['title'] = "My Real Title";
			$data['heading'] = "My Real Heading";

			echo view('blogview', $data);
		}
	}

Now open your view file and change the text to variables that correspond to the array keys in your data::

	<html>
	<head>
        <title><?= $title ?></title>
	</head>
	<body>
        <h1><?= $heading ?></h1>
	</body>
	</html>

Then load the page at the URL you've been using and you should see the variables replaced.

The data passed in is only available during one call to `view`. If you call the function multiple times
in a single request, you will have to pass the desired data to each view. This keeps any data from "bleeding" into
other views, potentially causing issues. If you would prefer the data to persist, you can pass the `saveData` option
into the `$option` array in the third parameter.
::

	$data = [
		'title' => 'My title',
		'heading' => 'My Heading',
		'message' => 'My Message'
	];

	echo view('blogview', $data, ['saveData' => true]);

Direct Access To View Class
===========================

The ``view()`` function is a convenience method that grabs an instance of the ``renderer`` service,
sets the data, and renders the view. While this is often exactly what you want, you may find times where you
want to work with it more directly. In that case you can access the View service directly::

	$renderer = \Config\Services::renderer();

.. important:: You should create services only within controllers. If you need access to the View class
	from a library, you should set that as a dependency in the constructor.

Then you can use any of the three standard methods that it provides.

* **render('view_name', array $options)** Performs the rendering of the view and its data. The $options array is
	unused by default, but provided for third-party libraries to use when integrating with different template engines.
* **setVar('name', 'value', $context=null)** Sets a single piece of dynamic data.  $context specifies the context
	to escape for. Defaults to no escaping. Set to empty value to skip escaping.
* **setData($array, $context=null)** Takes an array of key/value pairs for dynamic data and optionally escapes it.
	$context specifies the context to escape for. Defaults to no escaping. Set to empty value to skip escaping.

The `setVar()` and `setData()` methods are chainable, allowing you to combine a number of different calls together in a chain::

	service('renderer')->setVar('one', $one)
	                   ->setVar('two', $two)
	                   ->render('myView');

Escaping Data
=============

When you pass data to the ``setVar()`` and ``setData()`` functions you have the option to escape the data to protect
against cross-site scripting attacks. As the last parameter in either method, you can pass the desired context to
escape the data for. See below for context descriptions.

If you don't want the data to be escaped, you can pass `null` or `raw` as the final parameter to each function::

	$renderer->setVar('one', $one, 'raw');

If you choose not to escape data, or you are passing in an object instance, you can manually escape the data within
the view with the ``esc()`` function. The first parameter is the string to escape. The second parameter is the
context to escape the data for (see below)::

	<?= esc($object->getStat()) ?>

Escaping Contexts
-----------------

By default, the ``esc()`` and, in turn, the ``setVar()`` and ``setData()`` functions assume that the data you want to
escape is intended to be used within standard HTML. However, if the data is intended for use in Javascript, CSS,
or in an href attribute, you would need different escaping rules to be effective. You can pass in the name of the
context as the second parameter. Valid contexts are 'html', 'js', 'css', 'url', and 'attr'::

	<a href="<?= esc($url, 'url') ?>" data-foo="<?= esc($bar, 'attr') ?>">Some Link</a>

	<script>
		var siteName = '<?= esc($siteName, 'js') ?>';
	</script>

	<style>
		body {
			background-color: <?= esc('bgColor', 'css') ?>
		}
	</style>

Creating Loops
==============

The data array you pass to your view files is not limited to simple variables. You can pass multi dimensional
arrays, which can be looped to generate multiple rows. For example, if you pull data from your database it will
typically be in the form of a multi-dimensional array.

Here’s a simple example. Add this to your controller::

	class Blog extends \CodeIgniter\Controller
	{
		public function index()
		{
			$data = [
				'todo_list' => ['Clean House', 'Call Mom', 'Run Errands'],
				'title'     => "My Real Title",
				'heading'   => "My Real Heading"
			];

			echo view('blogview', $data);
		}
	}

Now open your view file and create a loop::

	<html>
	<head>
		<title><?= $title ?></title>
	</head>
	<body>
		<h1><?= $heading ?></h1>

		<h3>My Todo List</h3>

		<ul>
		<?php foreach ($todo_list as $item):?>

			<li><?= $item ?></li>

		<?php endforeach;?>
		</ul>

	</body>
	</html>

View Cells
==========

View Cells allow you to insert HTML that is generated outside of your controller. It simply calls the specified
class and method, which must return valid HTML. This method could be in an callable method, found in any class
that the autoloader can locate. The only restriction is that the class can not have any constructor parameters.
This is intended to be used within views, and is a great aid to modularizing your code.
::

    <?= view_cell('\App\Libraries\Blog::recentPosts') ?>

In this example, the class ``App\Libraries\Blog`` is loaded, and the method ``recentPosts()`` is ran. That method
must return a string with the generated HTML. The method used can be either a static method or not. Either way works.

Cell Parameters
---------------

You can further refine the call by passing a string with a list of parameters in the second parameter that are passed
to the method as an array of key/value pairs, or a comma-seperated string of key/value pairs::

    // Passing Parameter Array
    <?= view_cell('\App\Libraries\Blog::recentPosts', ['category' => 'codeigniter', 'limit' => 5]) ?>

    // Passing Parameter String
    <?= view_cell('\App\Libraries\Blog::recentPosts', 'category=codeigniter, limit=5') ?>

    public function recentPosts(array $params=[])
    {
        $posts = $this->blogModel->where('category', $params['category'])
                                 ->orderBy('published_on', 'desc')
                                 ->limit($params['limit'])
                                 ->get();

        return view('recentPosts', ['posts' => $posts]);
    }

Additionally, you can use parameter names that match the parameter variables in the method for better readability.
When you use it this way, all of the parameters must always be specified in the view cell call::

    <?= view_cell('\App\Libraries\Blog::recentPosts', 'category=codeigniter, limit=5') ?>

    public function recentPosts(int $limit, string $category)
    {
        $posts = $this->blogModel->where('category', $category)
                                 ->orderBy('published_on', 'desc')
                                 ->limit($limit)
                                 ->get();

        return view('recentPosts', ['posts' => $posts]);
    }

Cell Caching
------------

You can cache the results of the view cell call by passing the number of seconds to cache the data for as the
third parameter. This will use the currently configured cache engine.
::

    // Cache the view for 5 minutes
    <?= view_cell('\App\Libraries\Blog::recentPosts', 'limit=5', 300) ?>

You can provide a custom name to use instead of the auto-generated one if you like, by passing the new name
as the fourth parameter.::

    // Cache the view for 5 minutes
    <?= view_cell('\App\Libraries\Blog::recentPosts', 'limit=5', 300, 'newcacheid') ?>

