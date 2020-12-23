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

この `開発版ユーザーガイド <https://codeigniter4.github.io/CodeIgniter4/>`_  はオンラインでアクセスできます。.
これはリリースされたユーザーガイドとは異なり、開発ブランチに明示的に関係すること
を注意してください。.

プロジェクトルート ::

    php builds development

上記のコマンドは 作業リポジトリの ``develop`` を指すように  **composer.json** を更新し、
configフィアルトXMLファイルの対応するパスを更新します。これらの変更を元に戻す場合
次のコマンドを実行します::

    php builds release

``builds`` コマンドを実行した後、必ず ``composer update`` を実行して
vendor フォルダを最新のターゲットビルドと同期させてください。 

既存のプロジェクトにCodeIgniter4を追加する
============================================================

The same `CodeIgniter 4 framework <https://github.com/codeigniter4/framework>`_ 
repository described in "Manual Installation" can also be added to an
existing project using Composer.

Develop your app inside the ``app`` folder, and the ``public`` folder 
will be your document root. 

プロジェクトルート ::

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
