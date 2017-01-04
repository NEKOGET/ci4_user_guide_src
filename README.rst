######################
CodeIgniter ユーザーガイド
######################

******************
セットアップ手順
******************

CodeIgniterユーザガイドでは、Sphinxを使用して
さまざまな形式のドキュメントとして出力します。ページは人間が読めるように
`ReStructured Text <http://sphinx.pocoo.org/rest.html>`_ 形式で書かれています。

前提条件
=============

SphinxにはPythonが必要です。PythonはOS Xを利用している場合にはすでにインストールされています。
``python`` コマンドをパラメータなしで実行すると、
ターミナルで確認できますロードし、
インストールしたバージョンを教えてください。あなたが2.7以上でないなら、次のURLから2.7.2をインストールしてください
http://python.org/download/releases/2.7.2/

インストール
============

1. `easy_install <http://peak.telecommunity.com/DevCenter/EasyInstall#installing-easy-install>`_ をインストール
2. ``easy_install "sphinx==1.4.5"``
3. ``easy_install sphinxcontrib-phpdomain``
4. Install the CI Lexer which allows PHP, HTML, CSS, and JavaScript syntax highlighting in code examples (see *cilexer/README*)
5. ``cd user_guide_src``
6. ``make html``

ドキュメントの編集と作成
==================================

すべてのソースファイルは *source/* 以下にあります。 新しいドキュメントを追加したり
既存のドキュメントの変更修正をする場所です。コードの変更と同様に、
feature ブランチから作業し、
 このレポジトリの *develop* ブランチにプルリクエストを行うことをお勧めします。

HTMLはどこにあるの？
====================

HTMLドキュメントは読点ユーザがまず目にするドキュメントであり、
私たちが最も気になるところですが
ビルドファイルの履歴には価値がないためソース管理されません。そのため
それらを表示をしたい場合にはソースコードからビルドします。HTMLをビルドすることは
とても簡単です。あなたのユーザガイドのルートディレクトリで
インストール手順の最後に使用したコマンドを実行してください。

	make html

素晴らしく完璧にレンダリングされたユーザーガイドとその画像は
*build/html/* の中に保存されます。HTMLがビルドされると
変更されたファイルのみを再構築し
かなりの時間を節約します。何らかの理由でビルドファイルを "リセット" したい場合は
 *build* ディレクトリの中身を削除して再度ビルドしてください。 

***************
スタイルガイドライン
***************

Sphinxを使用してCodeIgniterを文書化する際の一般的なガイドラインについては
source/documentation/index.rst を参照してください。
