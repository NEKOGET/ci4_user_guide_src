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

HTMLドキュメントは、ユーザがまず目にするドキュメントであり、
私たちが最も気になるところです。Since revisions to the built
files are not of value, they are not under source control.  This also allows
you to regenerate as necessary if you want to "preview" your work.  Generating
the HTML is very simple.  From the root directory of your user guide repo
fork issue the command you used at the end of the installation instructions::

	make html

You will see it do a whiz-bang compilation, at which point the fully rendered
user guide and images will be in *build/html/*.  After the HTML has been built,
each successive build will only rebuild files that have changed, saving
considerable time.  If for any reason you want to "reset" your build files,
simply delete the *build* folder's contents and rebuild.

***************
Style Guideline
***************

Please refer to source/documentation/index.rst for general guidelines for
using Sphinx to document CodeIgniter.
