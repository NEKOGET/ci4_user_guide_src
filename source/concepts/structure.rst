#####################
アプリケーション 構造
#####################

CodeIgniterを最大限に利用するために, 
アプリケーションの構造とデフォルト、そして変更できることについて理解する必要があります。

デフォルトディレクトリ
===================

新規インストールをすると6つのディレクトリができます。: ``/application``, ``/system``, ``/public``, 
``/writable``, ``/tests`` and ``/docs``.
これらのディレクトリはそれぞれ役割を持っています。.

application
-----------
``application`` のディレクトリはアプリケーションのすべてのコードが存在します。デェフォルトのディレクトリ構造は
多くのアプリケーションに適しています。次のフォルダは、基本的な内容を作ります:

	/application
		/Config		設定ファイルを格納します。
		/Controllers		コントローラーはプログラムフローを決定します。
		/Helpers		ヘルパーは、独立型機能のコードを保存します
		/Language		スタンドアロン関数のコレクションを格納するここで、複数言語サポート言語の文字列を読み取ります。
		/Libraries		Useful classes that don't fit in another category
		/Models		Models work with the database to represent the business entities.
		/Views          ビューは、クライアントに表示されるHTMLを生成します。


``application`` ディレクトリはすでに名前空間の設定がされているため
アプリケーションの必要に応じてこのディレクトリの構造は自由に変更できます。For example, you might decide to start using the Repository
pattern and Entity Models to work with your data. In this case, you could rename the ``Models`` directory to
``Repositories``, and add a new ``Entities`` directory.

.. note:: If you rename the ``Controllers`` directory, though, you will not be able to use the automatic method of
		routing to controllers, and will need to define all of your routes in the routes file.

All files in this directory live under the ``App`` namespace, though you are free to change that in
**application/Config/Constants.php**.

system
------
This directory stores the files that make up the framework, itself. While you have a lot of flexibility in how you
use the application directory, the files in the system directory should never be modified. Instead, you should
extend the classes, or create new classes, to provide the desired functionality.

All files in this directory live under the ``CodeIgniter`` namespace.

public
------

The **public** folder holds the browser-acceible portion of your web application,
preventing direct access to your source code.
It contains the main **.htaccess** file, **index.php**, and any application 
assets that you add, like CSS, javascript, or
images.

This folder is meant to be the "web root" of your site, and your web server
would be configured to point to it.

writable
--------
This directory holds any directories that might need to be written to in the course of an application's life.
This includes directories for storing cache files, logs, and any uploads a user might send. You should add any other
directories that your application will need to write to here. This allows you to keep your other primary directories
non-writable as an added security measure.


tests
-----
This directory is setup to hold your test files. The ``_support`` directory holds various mock classes and other
utilities that you can use while writing your tests. This directory does not need to be transferred to your
production servers.

docs
----
このディレクトリは、CodeIgniterのドキュメントを保持しています。The ``user_guide`` subfolder contains a local copy of the
User Guide, and the ``api_docs`` subfolder contains a local copy of the CodeIgniter components API reference.

 ディレクトリの場所の変更
-----------------------------

If you've relocated any of the main directories, you can let the application 
know the new location within the main ``index.php`` file.

Starting around line 50, you will find three variables that hold the location to the **application**,
**system**, and **writable** directories. These paths are relative to **index.php**. 
