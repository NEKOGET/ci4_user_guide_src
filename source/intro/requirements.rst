###################
サーバー要件
###################

`PHP <https://www.php.net/>`_ バージョン 7.2 以降が必要です。
そして拡張機能 `*intl* extension <https://www.php.net/manual/en/intl.requirements.php>`_ および `*mbstring* extension <https://www.php.net/manual/en/mbstring.requirements.php>`_
がインストールされていることが必要となります。

次のPHP の拡張機能を有効にする必要があります。:
``php-json``, ``php-mysqlnd``, ``php-xml``

:doc:`CURLRequest </libraries/curlrequest>` を使用する場合には
`libcurl <https://www.php.net/manual/en/curl.requirements.php>`_ をインストールする必要があります。

ほとんどのWebアプリケーションプログラミングにはデータベースが必要です。
現在サポートされているデータベースは次の通りです。:

  - MySQL (5.1+)  *MySQLi* driver を利用します。
  - PostgreSQL *Postgre* driverを利用します。
  - SQLite3  *SQLite3* driver を利用します

すべてのドライバーが CodeIgniter4用に変換/書き換え が行われているわけではありません。
次のリストは、未解決のものです。

  - MySQL (5.1+)   *pdo* driverを使用するもの
  - Oracle  *oci8* と *pdo* driversを使用するもの
  - PostgreSQL  *pdo* driverを使用するもの
  - MS SQL  *mssql*, *sqlsrv* (version 2005とそれ以降のもの) と *pdo* driverを使用するもの
  - SQLite  *sqlite*  (version 2)と *pdo* driver を使用するもの
  - CUBRID *cubrid* と *pdo* driverを使用するもの
  - Interbase/Firebird  *ibase* と *pdo* driverを使用するもの。
  - ODBC *odbc* と *pdo* drivers を使用するもの(ODBCは実際には抽象化レイヤーであることを知っておいてください。)
