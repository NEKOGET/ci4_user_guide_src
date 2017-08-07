#########################
ユーザーガイドの生成
########################

ユーザーガイドは、PRマージの一部として自動的に生成される編集中のユーザーガイドです。この記事では、どのようにメンテナンスするかを
i説明します。

このユーザーガイドは  GitHubを利用しています。 ここではHTMLのみを含む "gh-pages" ブランチ
に触れます。`github.io
<https://bcit-ci.github.io/CodeIgniter4>`_.

セットアップ手順
==========================

すでに ``CodeIgniter4`` プロジェクトフォルダをクローンしていた場合。
それと同じレベルのフォルダ``CodeIgniter4-guide`` を作成します　。
 CodeIgniter4レポジトリを再び、 ``CodeIgniter4-guide/html`` にクローンします。

 ``html`` フォルダーの中で ``git checkout gh-pages`` します。
表示されるのはユーザーガイド用に生成されたHTMLだけです。

ユーザーガイドの再生成
============================

``user_guide_src``フォルダにはテスト用のコマンドを
使用します。::

	make html

ターゲットが設定されていて同じHTMLを生成します。
 ``html`` フォルダ内に2番目のレポジトリのクローンが生成されます::

	make ghpages

このターゲットを作成した後
 ``CodeIgniter4-guide/html`` フォルダに切り替えてオンラインのユーザーガイドを更新しましょう。::

	git add .
	git commit -S -m "Suitable comment"
	git push origin gh-pages

プロセス
=======

衝突を避けるために、PRのmerge作業を行うメンテナーは1名です。
The user guide would get regenerated whenever there is a PR merge
that affects it.

注意: ``user_guide_src/doctree`` フォルダーを
再構築の前に削除する必要があります。
特に ``html``  をなんどもターゲットにしている場合はTOCが正しく再構築されていることを確認してください。.
