ニュースアイテムを作成する
###############################################################################

CodeIgniterを使用して、データベースからデータを読み取る方法を理解しましたが、
まだデータベースへの書き込みはしていません。このセクションでは、前に作成した 
ニュースコントローラとモデルを拡張して
この機能を追加します。

フォームの作成
-------------------------------------------------------

データベースにデータを入力するには、
保存する情報を入力できるフォームを作成する必要があります。つまり、タイトルとテキストの2つのフィールドを持つ
フォームが必要になります。モデルのタイトルから
slug(スラグ）を派生させます。新しいビューを
**app/Views/news/create.php** に作成します。

::

    <h2><?= esc($title); ?></h2>

    <?= \Config\Services::validation()->listErrors(); ?>

    <form action="/news/create" method="post">
        <?= csrf_field() ?>

        <label for="title">Title</label>
        <input type="input" name="title" /><br />

        <label for="body">Text</label>
        <textarea name="body"></textarea><br />

        <input type="submit" name="submit" value="Create news item" />

    </form>

見慣れないものは、おそらく2つだけです。``\Config\Services::validation()->listErrors()``  関数は
バリデーションチェックに関連する
エラーを報告するために使用されます。``csrf_field()`` 関数は、いくつかの一般的な
攻撃からの保護に役立つ、 CSRF トークンを非表示入力入力タグを生成します。

``News`` コントローラーに戻ります。ここでは2つのことを行います。
フォームが送信されたかどうか、および送信されたデータが
バリデーションルールを通過したかどうかを確認します。これを行うには、  :doc:`フォーム
バリデーション<../libraries/validation>`  ライブラリを使用します。

::

    public function create()
    {
        $model = new NewsModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
                'title' => 'required|min_length[3]|max_length[255]',
                'body'  => 'required'
            ]))
        {
            $model->save([
                'title' => $this->request->getPost('title'),
                'slug'  => url_title($this->request->getPost('title'), '-', TRUE),
                'body'  => $this->request->getPost('body'),
            ]);

            echo view('news/success');
            
        }
        else
        {
            echo view('templates/header', ['title' => 'Create a news item']);
            echo view('news/create');
            echo view('templates/footer');
        }
    }

上記のコードでは多くの機能が追加されます。まず、NewsModelをロードします。
そして、``POST`` リクエストをショルするかどうかを確認し、
コントローラが提供しているヘルパー関数を使用して、
 $_POST  フィールドを検証します。この場合、タイトルとテキストのフィールドは必須項目となります。

このようにCodeIgniterには強力なバリデーションライブラリが
存在します。このライブラリの詳細は  :doc:`こちら <../libraries/validation>` を参照してください。

続いて、フォームのバリデーションチェックが正常に実行されたかどうか
が確認します。正常に通過しなかった場合は、フォームが表示されます。
**送信された項目が、すべてのバリデーションルールに合格する** とモデルが呼び出されます。 これにより
ニュース項目をモデルに渡すことができました。
これには新しい関数 ``url_title()`` が含まれています。この関数 -
:doc:`URL ヘルパー <../helpers/url_helper>` によって提供されます - 
渡した空白文字列を削除し、
すべてのスペースをダッシュ (-) で置き換え、すべてが小文字であることを確認します。これにより、URLの作成に最適な素晴らしい
slugが作成されます。

この後、ビューがロードされ、成功メッセージが表示されます。**app/Views/news/success.php** に
ビューを作成し、成功メッセージを書き込みます。

これは次のように簡単です。:

::

    ニュースアイテムの作成が成功しました！

モデルの更新
-------------------------------------------------------

The only thing that remains is ensuring that your model is set up
to allow data to be saved properly. The ``save()`` method that was
used will determine whether the information should be inserted
or if the row already exists and should be updated, based on the presence
of a primary key. In this case, there is no ``id`` field passed to it,
so it will insert a new row into it's table, **news**.

However, by default the insert and update methods in the model will
not actually save any data because it doesn't know what fields are
safe to be updated. Edit the model to provide it a list of updatable
fields in the ``$allowedFields`` property.

::

    <?php namespace App\Models;
    use CodeIgniter\Model;

    class NewsModel extends Model
    {
        protected $table = 'news';

        protected $allowedFields = ['title', 'slug', 'body'];
    }

This new property now contains the fields that we allow to be saved to the
database. Notice that we leave out the ``id``? That's because you will almost
never need to do that, since it is an auto-incrementing field in the database.
This helps protect against Mass Assignment Vulnerabilities. If your model is
handling your timestamps, you would also leave those out.

ルーティング
-------------------------------------------------------

Before you can start adding news items into your CodeIgniter application
you have to add an extra rule to **app/Config/Routes.php** file. Make sure your
file contains the following. This makes sure CodeIgniter sees ``create``
as a method instead of a news item's slug. You can read more about different
routing types :doc:`here </incoming/routing>`.

::

    $routes->match(['get', 'post'], 'news/create', 'News::create');
    $routes->get('news/(:segment)', 'News::view/$1');
    $routes->get('news', 'News::index');
    $routes->get('(:any)', 'Pages::view/$1');

Now point your browser to your local development environment where you
installed CodeIgniter and add ``/news/create`` to the URL.
Add some news and check out the different pages you made.

.. image:: ../images/tutorial3.png
    :align: center
    :height: 415px
    :width: 45%

.. image:: ../images/tutorial4.png
    :align: center
    :height: 415px
    :width: 45%

Congratulations
-------------------------------------------------------

You just completed your first CodeIgniter4 application!

The image underneath shows your project's **app** folder,
with all of the files that you created in green.
The two modified configuration files (Database & Routes) are not shown.

.. image:: ../images/tutorial9.png
    :align: left
