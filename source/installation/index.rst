############
インストール
############

CodeIgniter4 は様々な方法でインストールできます。
`Composer <https://getcomposer.org>`_ を使うこともできますし、
`Git <https://git-scm.com/>`_ を使うこともできますね！
どちらがあなたにぴったりですか?

- 簡単に "ダウンロードして実行" をしたい場合はCodeIgniter3と同様に、
  手動インストールを選択します。
- サードパーティ製のパッケージをプロジェクトに追加する予定がある場合は
  CodeIgniter が簡単に最新の状態になるように、composer インストールをお勧めします。

.. toctree::
    :titlesonly:

    installing_manual
    installing_composer
    running
    upgrading
    troubleshooting
    repositories

CodeIgniter4をインストールして実行する場合、
`ユーザーガイド <https://codeigniter4.github.io/userguide/>`_  にはオンラインでアクセスすることができます。

.. note:: CodeIgniter 4を使用する前にサーバー要件について確認をしてください。
          特に、:doc:`requirements </intro/requirements>`
          PHPのバージョンと必要なPHP拡張機能について確認しましょう。
          ``php.ini``  の "extension" のコメントを解除する必要がある場合があります。
          例えば "curl" と "intl" を有効にする場合に必要です。
