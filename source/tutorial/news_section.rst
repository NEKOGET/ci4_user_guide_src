ニュースセクション
###############################################################################

前のセクションでは、静的ページを参照するクラスを作成し、
フレームワークの基本的な概念を説明しました。カスタムルーティングルールを追加して
URLをきれいにしました。次は動的なコンテンツを追加します。
そして、データベースの使用を開始します。

使用するデータベースの作成
-------------------------------------------------------

CodeIgniterのインストールでは、 :doc:`サーバー要件</intro/requirements>`.
で示されているように、適切なデータベースが存在していることを想定しています。
このチュートリアルでは、MySQLのSQLコードを提供します。
また、データベースコマンド 
を発行するための適切なクライアントがあることも前提としています。 (mysql, MySQL Workbench, or phpMyAdmin)

このチュートリアルで使用するデータベースを作成する必要があります。
そして、それを使用するようにCodeIgniterを構成します。

データベースクライアントを使用して、データベースに接続し次のSQLコマンドを実行します。(MySQL).
またいくつかのレコードを追加します。ここではテーブル作成に必要なSQLステートメントのみを示します。
CodeIgniterになれれば、プログラムでこれを実行可能なことに注意をしてください。詳しくは、
:doc:`Migrations <../dbmgmt/migration>` と
:doc:`Seeds <../dbmgmt/seeds>`  を参照してください。より便利にデーターベースを設定作成できます。

::

    CREATE TABLE news (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        body text NOT NULL,
        PRIMARY KEY (id),
        KEY slug (slug)
    );

注意: Web公開のコンテキストにおける  "slug" はリソースを識別および説明するためにURLで使用される
ユーザーおよびSEOフレンドリーな短いテキストです。

シードレコードは次のようになります:

::

    INSERT INTO news VALUES
    (1,'Elvis sighted','elvis-sighted','Elvis was sighted at the Podunk internet cafe. It looked like he was writing a CodeIgniter app.'),
    (2,'Say it isn\'t so!','say-it-isnt-so','Scientists conclude that some programmers have a sense of humor.'),
    (3,'Caffeination, Yes!','caffeination-yes','World\'s largest coffee shop open onsite nested coffee shop for staff only.');

データベースへ接続
-------------------------------------------------------

CodeIgniterをインストールをした時に作成したローカル設定ファイル  ``.env`` に
データベースプロバティの設定をコメント解除し、使用するデータベースにあわせて
適切に設定をする必要があります。:doc:`こちら <../database/configuration>` の説明に従って、
データベースの構成が適切であることを確認してください。

::

    database.default.hostname = localhost
    database.default.database = ci4tutorial
    database.default.username = root
    database.default.password = root
    database.default.DBDriver = MySQLi

モデルのセットアップ
-------------------------------------------------------

コントローラでデータベース操作を記述するのではなく、
クエリをモデルに配置して、再利用できるようにします。モデルは
データベースもしくは他のデータストアの情報を取得、挿入および
更新する場所です。データベースへのアクセスを提供します。
さらに詳しく知りたい場合は、 :doc:`こちら </models/model>` を読むと良いでしょう。

**app/Models/** ディレクトリを開き、**NewsModel.php**
ファイルを作成しましょう。そして次のコードを追加します。

::

    <?php namespace App\Models;

    use CodeIgniter\Model;

    class NewsModel extends Model
    {
        protected $table = 'news';
    }

このコードは以前に使用した以前に使用したコントローラのコードに似ています。``CodeIgniter\Model``  をextendして新しいモデルを作成し、
データベースライブラリを
ロードします。これはデータベースクラスを ``$this->db``  
オブジェクトを通じて利用可能にするものです。

Now that the database and a model have been set up, you'll need a method
to get all of our posts from our database. To do this, the database
abstraction layer that is included with CodeIgniter —
:doc:`Query Builder <../database/query_builder>` — is used. This makes it
possible to write your 'queries' once and make them work on :doc:`all
supported database systems <../intro/requirements>`. The Model class
also allows you to easily work with the Query Builder and provides
some additional tools to make working with data simpler. Add the
following code to your model.

::

    public function getNews($slug = false)
    {
        if ($slug === false)
        {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(['slug' => $slug])
                    ->first();
    }

With this code, you can perform two different queries. You can get all
news records, or get a news item by its `slug <#>`_. You might have
noticed that the ``$slug`` variable wasn't sanitized before running the
query; :doc:`Query Builder <../database/query_builder>` does this for you.

The two methods used here, ``findAll()`` and ``first()``, are provided
by the Model class. They already know the table to use based on the ``$table``
property we set in **NewsModel** class, earlier. They are helper methods
that use the Query Builder to run their commands on the current table, and
returning an array of results in the format of your choice. In this example,
``findAll()`` returns an array of objects.

Display the news
-------------------------------------------------------

Now that the queries are written, the model should be tied to the views
that are going to display the news items to the user. This could be done
in our ``Pages`` controller created earlier, but for the sake of clarity,
a new ``News`` controller is defined. Create the new controller at
**app/Controllers/News.php**.

::

    <?php namespace App\Controllers;

    use App\Models\NewsModel;
    use CodeIgniter\Controller;

    class News extends Controller
    {
        public function index()
        {
            $model = new NewsModel();

            $data['news'] = $model->getNews();
        }

        public function view($slug = null)
        {
            $model = new NewsModel();

            $data['news'] = $model->getNews($slug);
        }
    }

Looking at the code, you may see some similarity with the files we
created earlier. First, it extends a core CodeIgniter class, ``Controller``,
which provides a couple of helper methods, and makes sure that you have
access to the current ``Request`` and ``Response`` objects, as well as the
``Logger`` class, for saving information to disk.

Next, there are two methods, one to view all news items, and one for a specific
news item. You can see that the ``$slug`` variable is passed to the model's
method in the second method. The model is using this slug to identify the
news item to be returned.

Now the data is retrieved by the controller through our model, but
nothing is displayed yet. The next thing to do is, passing this data to
the views. Modify the ``index()`` method to look like this::

    public function index()
    {
        $model = new NewsModel();

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);
    }

The code above gets all news records from the model and assigns it to a
variable. The value for the title is also assigned to the ``$data['title']``
element and all data is passed to the views. You now need to create a
view to render the news items. Create **app/Views/news/overview.php**
and add the next piece of code.

::

    <h2><?= esc($title); ?></h2>

    <?php if (! empty($news) && is_array($news)) : ?>

        <?php foreach ($news as $news_item): ?>

            <h3><?= esc($news_item['title']); ?></h3>

            <div class="main">
                <?= esc($news_item['body']); ?>
            </div>
            <p><a href="/news/<?= esc($news_item['slug'], 'url'); ?>">View article</a></p>

        <?php endforeach; ?>

    <?php else : ?>

        <h3>No News</h3>

        <p>Unable to find any news for you.</p>

    <?php endif ?>


.. note:: We are again using using **esc()** to help prevent XSS attacks.
    But this time we also passed "url" as a second parameter. That's because
    attack patterns are different depending on the context in which the output
    is used. これについては、 :doc:`こちら </general/common_functions>` で詳細を確認することができます。

Here, each news item is looped and displayed to the user. You can see we
wrote our template in PHP mixed with HTML. If you prefer to use a template
language, you can use CodeIgniter's :doc:`View
Parser </outgoing/view_parser>` or a third party parser.

The news overview page is now done, but a page to display individual
news items is still absent. The model created earlier is made in such
a way that it can easily be used for this functionality. You only need to
add some code to the controller and create a new view. Go back to the
``News`` controller and update the ``view()`` method with the following:

::

    public function view($slug = NULL)
    {
        $model = new NewsModel();

        $data['news'] = $model->getNews($slug);

        if (empty($data['news']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['news']['title'];

        echo view('templates/header', $data);
        echo view('news/view', $data);
        echo view('templates/footer', $data);
    }

Instead of calling the ``getNews()`` method without a parameter, the
``$slug`` variable is passed, so it will return the specific news item.
The only thing left to do is create the corresponding view at
**app/Views/news/view.php**. Put the following code in this file.

::

    <h2><?= esc($news['title']); ?></h2>
    <?= esc($news['body']); ?>

ルーティング
-------------------------------------------------------

Because of the wildcard routing rule created earlier, you need an extra
route to view the controller that you just made. Modify your routing file
(**app/Config/Routes.php**) so it looks as follows.
This makes sure the requests reach the ``News`` controller instead of
going directly to the ``Pages`` controller. The first line routes URI's
with a slug to the ``view()`` method in the ``News`` controller.

::

    $routes->get('news/(:segment)', 'News::view/$1');
    $routes->get('news', 'News::index');
    $routes->get('(:any)', 'Pages::view/$1');

Point your browser to your "news" page, i.e. ``localhost:8080/news``,
you should see a list of the news items, each of which has a link
to display just the one article.

.. image:: ../images/tutorial2.png
    :align: center
