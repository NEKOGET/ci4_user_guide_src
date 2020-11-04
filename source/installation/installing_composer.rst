Composer インストール
###############################################################################

.. contents::
    :local:
    :depth: 1

CodeIgniter4ではcomposerを使ってインストールすることも可能です。

最初に、
CodeIgniter4を使ってスケルトンプロジェクトを作成し、それをWebアプリのベースとして使用する方法を紹介します。
以下で説明する方法はCodeIgniter4 を既存のWebアプリに追加することができます。
webapp, 

**Note**:  Gitリポジトリを利用してコードを保存している場合、
また、他のユーザとのコラボレーションのために使用している場合は 通常 ``vendor``フォルダー以下の
ものは "git から無視" されます。このような場合には、
``composer update`` を利用する必要があります。 

アプリスターター
============================================================

`CodeIgniter 4 アプリスターター <https://github.com/codeigniter4/appstarter>`_ 
はスケルトンアプリケーションを保持しつつ、
composer が最新リリースのバージョンのものを取得します。

このインストール方法は、
新しいCodeIgniter4ベースのプロジェクトを開始したい開発者に最適な方法です。

インストールとセットアップ
-------------------------------------------------------

プロジェクトルート上のフォルダ :

    composer create-project codeigniter4/appstarter project-root

このコマンドは "project-root"  フォルダーを作成し実行されます。

"project-root" 引数を省略するとコマンドによって
"appstarter"  フォルダが作成され、必要に応じて名前を変更することが可能です。

phpunitとその全てのcomposer依存関係をインストールする必要がない場合、
またはインストールしたくない場合には上記のコマンドの最後に
"--no-dev" のオプションを追加します。その結果、フレームワークと、バンドルされている3つの信頼できる依存関係のみが作成されるかたちで
composer install が実行し終了します。

標準の プロジェクトルート "appstarter" が作成されるコマンドサンプル ::

    composer create-project codeigniter4/appstarter --no-dev

インストール後 "アップグレード" の手順に従う必要があります。

アップグレード
-------------------------------------------------------

新しいリリースがあるときは、プロジェクトルートからコマンドラインを実行します:

    composer update 

 "--no-dev" オプションを利用してインストールした場合には
``composer update --no-dev``  といったように、オプションをつけて実行しましょう。

アップグレード手順を読み、影響を受ける変更がないか、  ``app/Config`` フォルダーの中身を確認しましょう。

長所
-------------------------------------------------------

とても簡単に、シンプルにアップデートができます。

短所
-------------------------------------------------------

更新後 ``app/Config`` の変更を確認する必要があります。

構造
-------------------------------------------------------

セットアップ後のプロジェクト内のフォルダー:

- app, public, tests, が書き込み可能かどうか
- vendor/codeigniter4/framework/system
- vendor/codeigniter4/framework/app と  public (composer updateを使って更新したあとあなたのファイルと比較して確認してください)

最新の開発
-------------------------------------------------------

App Starter リポジトリは Composerソースを現在の安定板リリースとフレームワークの最新の開発ブランチで切り替えるための 
``builds`` スクリプトが付属しています。このスクリプトは
不安定な可能性のある最新のみリリースの変更を喜んで受け入れる開発者のみが使用してください。

The `development user guide <https://codeigniter4.github.io/CodeIgniter4/>`_ is accessible online.
Note that this differs from the released user guide, and will pertain to the
develop branch explicitly.

In your project root::

    php builds development

The command above will update **composer.json** to point to the ``develop`` branch of the
working repository, and update the corresponding paths in config and XML files. To revert
these changes run::

    php builds release

After using the ``builds`` command be sure to run ``composer update`` to sync your vendor
folder with the latest target build.

Adding CodeIgniter4 to an Existing Project
============================================================

The same `CodeIgniter 4 framework <https://github.com/codeigniter4/framework>`_ 
repository described in "Manual Installation" can also be added to an
existing project using Composer.

Develop your app inside the ``app`` folder, and the ``public`` folder 
will be your document root. 

In your project root::

    composer require codeigniter4/framework

As with the earlier two composer install methods, you can omit installing
phpunit and its dependencies by adding the "--no-dev" argument to the "composer require" command.

Set Up
-------------------------------------------------------

Copy the ``app``, ``public``, ``tests`` and ``writable`` folders from ``vendor/codeigniter4/framework``
to your project root

Copy the ``env``, ``phpunit.xml.dist`` and ``spark`` files, from
``vendor/codeigniter4/framework`` to your project root

You will have to adjust the system path to refer to the vendor one, e.g. ``ROOTPATH . '/vendor/codeigniter4/framework/system'``,
- the ``$systemDirectory`` variable in ``app/Config/Paths.php``

アップグレード
-------------------------------------------------------

新しいリリースがあるときは、プロジェクトルートからコマンドラインを実行します:

    composer update 

Read the upgrade instructions, and check designated 
``app/Config`` folders for affected changes.

長所
-------------------------------------------------------

Relatively simple installation; easy to update

短所
-------------------------------------------------------

更新後 ``app/Config`` の変更を確認する必要があります。

構造
-------------------------------------------------------

セットアップ後のプロジェクト内のフォルダー:

- app, public, tests, writable 
- vendor/codeigniter4/framework/system


Translations Installation
============================================================

If you want to take advantage of the system message translations,
they can be added to your project in a similar fashion. 

From the command line inside your project root::

    composer require codeigniter4/translations

These will be updated along with the framework whenever you do a ``composer update``.
