#################################
CodeIgniter のドキュメントを書くということ
#################################

CodeIgniter uses Sphinx to generate its documentation in a variety of formats,
using reStructuredText to handle the formatting.  If you are familiar with
Markdown or Textile, you will quickly grasp reStructuredText.  読みやすさと使いやすさに
フォーカスしています。
私たちは人間が読むためのものを書き、スフィンクスはそれに対して機械的に動作します。

コンテンツのローカルテーブルは、常に以下のようになるべきです。
それは次のように挿入することで自動的に形成されます。:

::

	.. contents::
		:local:

	.. raw:: html

  	<div class="custom-index container"></div>

.. contents::
  :local:

.. raw:: html

  <div class="custom-index container"></div>

The <div> that is inserted as raw HTML is a hook for the documentation's
JavaScript to dynamically add links to any function and method definitions
contained in the current page.

**************
必要なツール
**************

HTML, ePub, PDF, 等にレンダリングしたいため
PHP ドメインの拡張モジュールと一緒にスフィンクスをインストールする必要があります。まず大前提として
Pythonがインストールされている必要があります。最後に、コードブロックが正しく強調表示されるように
PygmentsのためのCI Lexerをインストールします。

.. code-block:: bash

	easy_install "sphinx==1.2.3"
	easy_install sphinxcontrib-phpdomain

Then follow the directions in the README file in the :samp:`cilexer` folder
inside the documentation repository to install the CI Lexer.



*****************************************
ページとセクション、見出しと小見出しについて
*****************************************

Headings not only provide order and sections within a page, but they also
are used to automatically build both the page and document table of contents.
Headings are formed by using certain characters as underlines for a bit of
text.  Major headings, like page titles and section headings also use
overlines.  Other headings just use underlines, with the following hierarchy::

	# with overline for page titles
	* with overline for major sections
	= for subsections
	- for subsubsections
	^ for subsubsubsections
	" for subsubsubsubsections (!)

The :download:`TextMate ELDocs Bundle <./ELDocs.tmbundle.zip>` can help you
create these with the following tab triggers::

	title->

		##########
		ページタイトル
		##########

	sec->

		*************
		主なセクション
		*************

	sub->

		サブセクション
		==========

	sss->

		サブサブ セクション
		-------------

	ssss->

		サブサブサブ セクション
		^^^^^^^^^^^^^^^^

	sssss->

		サブサブサブサブ セクション (!)
		"""""""""""""""""""""""
