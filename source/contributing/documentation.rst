#################################
CodeIgniter のドキュメントを書くということ
#################################

Codeigniterではさまざまな形式でそのドキュメントを生成するためにスフィンクスを使用しています。
そのため、reStructuredTextが利用されています。マークダウンを使い慣れているならば、
すぐにreStructuredTextを使いこなせることでしょう。読みやすさと使いやすさに
フォーカスしました。
人間が読める文書で書き、テクニカルなことはスフィンクスにお任せです！

コンテンツのローカルテーブルは次のようになるはずです。
次のように挿入することで自動的に作成されます。:

::

	.. contents::
		:local:

	.. raw:: html

  	<div class="custom-index container"></div>

.. contents::
  :local:

.. raw:: html

  <div class="custom-index container"></div>

The <div> that is inserted as raw HTML is a event for the documentation's
JavaScript to dynamically add links to any function and method definitions
contained in the current page.

**************
T必要なツール
**************

HTML, ePub, PDF などを表示するには、
PHPドメインの拡張として、スフィンクスをインストールする必要があります。まず前提条件として
Python がインストールされている必要があります。最後に、Pygmentsの為の CI Lexer をインストールします。
それによってコードブロックが適切に強調表示することができます。

.. code-block:: bash

	easy_install "sphinx==1.2.3"
	easy_install sphinxcontrib-phpdomain

Then follow the directions in the README file in the :samp:`cilexer` folder
inside the documentation repository to install the CI Lexer.



*****************************************
Page and Section Headings and Subheadings
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
		Page Title
		##########

	sec->

		*************
		Major Section
		*************

	sub->

		Subsection
		==========

	sss->

		SubSubSection
		-------------

	ssss->

		SubSubSubSection
		^^^^^^^^^^^^^^^^

	sssss->

		SubSubSubSubSection (!)
		"""""""""""""""""""""""
