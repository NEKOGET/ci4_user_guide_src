**************
PSR対応について
**************

`PHP-FIG <https://www.php-fig.org/>`_ は2009年に作成されました。
インターフェイスやスタイルガイドを継承することでフレームワーク間でのコードの相互運用性を高めることを目的としています。CodeIgniter はFGのメンバーではありませんが、
この提案に対し対応をしています。このガイドは
PSRの草案提案に基準しています。それらは次の通りです。

**PSR-1: B基本コーディング標準**

この推奨時刻は、基本的なクラス、メソッドおよびファイルの命名基準を対象としています。私たちの
`スタイルガイド <https://github.com/codeigniter4/CodeIgniter4/blob/develop/contributing/styleguide.rst>`_
は PSR-1を満たしています。その上で独自の要件を追加しました。

**PSR-2: コーディングスタイルガイド**

This PSR was fairly controversial when it first came out. CodeIgniter meets many of the recommendations within,
but does not, and will not, meet all of them.

**PSR-3: Logger Interface**

CodeIgniter's :doc:`Logger </general/logging>` implements all of the interfaces provided by this PSR.

**PSR-4: Autoloading Standard**

This PSR provides a method for organizing file and namespaces to allow for a standard method of autoloading
classes. Our :doc:`Autoloader </concepts/autoloader>` meets the PSR-4 recommendations.

**PSR-6: Caching Interface**

CodeIgniter will not be trying to meet this PSR, as we believe it oversteps its needs. The newly proposed
`SimpleCache Interfaces <https://github.com/dragoonis/fig-standards/blob/psr-simplecache/proposed/simplecache.md>`_
do look like something we would consider.

**PSR-7: HTTP Message Interface**

This PSR standardizes a way of representing the HTTP interactions. While many of the concepts became part of our
HTTP layer, CodeIgniter does not strive for compatibility with this recommendation.

---

If you find any places that we claim to meet a PSR but have failed to execute it correctly, please let us know
and we will get it fixed, or submit a pull request with the required changes.
