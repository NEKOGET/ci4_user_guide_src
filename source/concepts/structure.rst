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
		/Config         設定ファイルを格納します。
		/Controllers		コントローラーはプログラムフローを決定します。
		/Helpers		ヘルパーは、独立型機能のコードを保存します
		/Language		スタンドアロン関数のコレクションを格納するここで、複数言語サポート言語の文字列を読み取ります。
		/Libraries		Useful classes that don't fit in another category
		/Models		Models work with the database to represent the business entities.
		/Views          ビューは、クライアントに表示されるHTMLを生成します。


``application`` ディレクトリはすでに名前空間の設定がされているため
アプリケーションの必要に応じて、このディレクトリの構造は自由に変更できます。たとえば、あなたはあなたのデータを操作するために
リポジトリパターンとエンティティモデルの使用を開始することを決定するとします。その場合  ``Models`` の名前を ``Repositories``  に変更し、
新たに ``Entities`` ディレクトリを追加します。

.. 注意:: もし ``Controllers`` ディレクトリの名前を変更する場合、コントローラに自動的なルーティングを使用することができません。
すべてのルートを定義する必要があります。

**application/Config/Constants.php** を変更することは自由ですが
このディレクトリ内のすべてのファイルは ``App``  名前空間以下に含まれます。

system
------
このディレクトリには、フレームワークを構成するファイルを格納します。アプリケーションディレクトリを使用する場合多くの柔軟性を持っていますが、
システムディレクトリ内のファイルを変更することはありません。Instead, you should
extend the classes, or create new classes, to provide the desired functionality.

このディレクトリ内のすべてのファイルは ``CodeIgniter`` の名前空間を持っています。

public
------

**public** フォルダは、ソースコードへの直接アクセスを防止し
ブラウザからアクセス可能なものを格納します。
 これは **.htaccess** ファイル、メインとなる **index.php** 、
及びCSS, Javascriopt
画像などの任意のファイルを含みます。

このフォルダはサイトの "web ルート" であることを意味し、
Webサーバをそうなるように設定することになります。

writable
--------
このディレクトリはアプリケーションの中で書き込みが必要なファイルを保存しておくことができます。
これは、キャッシュファイル、ログ、およびユーザが送信する可能性のある任意のアップロードを格納するためのディレクトリが含まれています。アプリケーションはここに書き込む必要がある
他のディレクトリを追加する必要があります。This allows you to keep your other primary directories
non-writable as an added security measure.


tests
-----
このディレクトリにはテストファイルを保存するように設定されています。``_support`` ディレクトリにはテストを書くときに使用するモッククラス
やユーティリティを保存できます。このディレクトリは本番サーバに転送する
必要はありません。

docs
----
このディレクトリは、CodeIgniterのドキュメントが保存されています。 ``user_guide``  フォルダにはローカルコピーが含まれており、
 ``api_docs`` フォルダにはCodeIgniterコンポーネントAPIリファレンスのローカルコピーが含まれています。

 ディレクトリの場所の変更
-----------------------------

メインディレクトリを変更した場合、
 ``index.php`` ファイルの中に新しい場所を指定することができます。

Starting around line 50, you will find three variables that hold the location to the **application**,
**system**, and **writable** directories. これらのパスは **index.php** を基準にしています。 
