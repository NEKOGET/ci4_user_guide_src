**************
PSR対応について
**************

`PHP-FIG <https://www.php-fig.org/>`_ は2009年に作成されました。
インターフェイスやスタイルガイドを継承することでフレームワーク間でのコードの相互運用性を高めることを目的としています。CodeIgniter はFGのメンバーではありませんが、
この提案に対し対応をしています。このガイドは
PSRの草案提案に基準しています。それらは次の通りです。

**PSR-1: 基本コーディング標準**

This recommendation covers basic class, method, and file-naming standards. Our
`style guide <https://github.com/codeigniter4/CodeIgniter4/blob/develop/contributing/styleguide.md>`_
meets PSR-1 and adds its own requirements on top of it.

**PSR-12: Extended Coding Style**

Our
`style guide <https://github.com/codeigniter4/CodeIgniter4/blob/develop/contributing/styleguide.md>`_ follows the recommendation plus a set of our own styling conventions.


**PSR-3: ロガーインターフェイス**

:doc:`ロガー </general/logging>` はこのPSRで提案されているすべてのインターフェイスを実装しています。  

**PSR-4: オートローデング標準**

このPSRはファイルと名前空間を整理し、
標準のオートロードを可能にする方法を提供しています。:doc:`Autoloader </concepts/autoloader>` は PSR-4 の推奨事項を満たしています。

**PSR-6: キャッシュインターフェイス**
**PSR-16: SimpleCache Interface**

While the framework Cache components do not adhere to PSR-6 or PSR-16, a separate set of adapters
are available from the CodeIgniter4 organization as a supplemental module. It is recommended that
projects use the native Cache drivers directly as the adapters are only intended for compatibility
with third-party libraries. For more information visit the `CodeIgniter4 Cache repo <https://github.com/codeigniter4/cache>`_.

**PSR-7: HTTP メッセージインターフェイス**

このPSRはHTTP対話を表す方法を標準化しています。コンセプトの多くは、私たちの一部となりました。
しかし、 CodeIgniterはHTMLレイヤーの推奨事項との互換性を追求していません。

---

PSRを満たすと私たちは主張していますが、満たせていない箇所、正しく実行できなかった箇所を発見した場合はおしらせください。修正するか、必要な変更を加えてプルリクエストします。
