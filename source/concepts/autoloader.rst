#################
ファイルのオートロード
#################

すべてのアプリケーションは、さまざまな場所にたくさんのクラスで構成されています。
このフレームワークは、コア機能の提供するクラスを提供します。あなたのアプリケーションは
動作させるために、ライブラリ、モデル、およびその他多くものを持つことになります。プロジェクトで利用されている
サードパーティなクラスも利用しているはずです。すべてのファイルを使うために、すべてを
都度 ``requires()`` と、ハードコーディングすることは、エラーも発生しやすく、
頭の痛い作業です。そこで、オートローダの出番です。

CodeIgniterは非常に柔軟なオートローダを提供し、とても小さな構成で使用することができます。
これは名前空間があるもの、ないものについて
`PSR4 <http://www.php-fig.org/psr/psr-4/>`_ のオートロードのディレクトリ構造で、
そして (コントローラ、モデルなど）共通ディレクトリ内の
クラスを探します。 

性能向上のためにCodeIgniterのコアコンポーネントはクラスマップに追加されました。

オートローダはそれだけでも機能しますが、必要に応じて他のオートローダや
`Composer <https://getcomposer.org>`_ や独自のカスタムオートローダを使用することもできます。
それらがすべては
`spl_autoload_register <http://php.net/manual/en/function.spl-autoload-register.php>`_,
を通じて登録されるので、それぞれがお互いを邪魔するといったことはありません。

オートローダーはフレームワークの実行開始時に ``spl_autoload_register()``  に登録され
常にアクティブです。

設定
=============

初期設定は **/application/Config/Autoload.php** で行われます。このファイルには主要な2つの配列が含まれています。
1つはクラスマップに対して、もう1つはPSR4互換名前空間に対するものです。

名前空間
==========

クラスを整理するために、アプリケーションのファイルのために1つもしくは複数の
名前空間を作成することをお勧めします。これは、エンティティクラスやビジネスロジックに関連するクラスのために
最も重要なことです。. 設定ファイルの中の ``psr4`` 配列を利用すると、それらのクラスを見つけることができるディレクトリに対して
名前空間をマッピングすることができます::

	$psr4 = [
		'App'         => APPPATH,
		'CodeIgniter' => BASEPATH,
	];

各行の配列のキーは名前空間そのものを表します。末尾にバックスラッシュは必要ありません。Iもしあなたがダブルクォートを使用する場合は
バックスラッシュをエスケープするようにしてください。That means that it would be ``My\\App``,
not ``My\App``. この値は、クラスを見つかることができるディレクトリの場所です。They should
have a trailing slash.

By default, the application folder is namespace to the ``App`` namespace. While you are not forced to namespace the controllers,
libraries, or models in the application directory, if you do, they will be found under the ``App`` namespace.
You may change this namespace by editing the **/application/Config/Constants.php** file and setting the
new namespace value under the ``APP_NAMESPACE`` setting::

	define('APP_NAMESPACE', 'App');

You will need to modify any existing files that are referencing the current namespace.

.. important:: Config files are namespaced in the ``Config`` namespace, not in ``App\Config`` as you might
	expect. This allows the core system files to always be able to locate them, even when the application
	namespace has changed.

クラスマップ
========

The classmap is used extensively by CodeIgniter to eke the last ounces of performance out of the system
by not hitting the file-system with extra ``file_exists()`` calls. You can use the classmap to link to
third-party libraries that are not namespaced::

	$classmap = [
		'Markdown' => APPPATH .'third_party/markdown.php'
	];

The key of each row is the name of the class that you want to locate. The value is the path to locate it at.

レガシーサポート
==============

If neither of the above methods find the class, and the class is not namespaced, the autoloader will look in the
**/application/Libraries** and **/application/Models** directories to attempt to locate the files. This provides
a measure to help ease the transition from previous versions.

There are no configuration options for legacy support.
