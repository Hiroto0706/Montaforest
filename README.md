# もんたの森
### このアプリについて
画像の投稿、編集、削除、読み込みができる画像投稿サイトです。<br>
検索機能にタグの名前を打ち込むことで一致する投稿を表示してくれます。<br>
ぜひみなさんの描いた絵だったり、おしゃれな画像を投稿してください！　　

### このアプリを作った理由
私は絵を描くことが好きでよく友人に壁紙用の絵を描いたり、自分のPC用に絵を描いています！<br>
そんな絵を投稿できて、タグでPC用の壁紙、アイコン用の壁紙だったりすぐに表示できたりタグ機能をつけて投稿できたらいいな〜と思って作りました！

## 使った技術
- PHP(8.1.2)
- Laravel(8.82.0)
- MySQL(8.0.27 for macos11.6 on arm64 (Homebrew))
- Docker(20.10.12)
  
　　
# デモ画面
### フロント画面
![スクリーンショット 2022-02-26 20 35 42](https://user-images.githubusercontent.com/87826418/155841648-a39a1ac9-718d-4d66-a879-8347905b7a95.jpg)
![スクリーンショット 2022-03-03 14 06 32](https://user-images.githubusercontent.com/87826418/156499988-f6eafc1a-b1f7-4b93-b2a1-94bb84ce0e60.jpg)
![スクリーンショット 2022-03-03 14 29 41](https://user-images.githubusercontent.com/87826418/156502269-834ce7ad-3716-4ef3-b786-96f7d84c4493.jpg)


### 画像の詳細画面
![スクリーンショット 2022-03-03 14 28 18](https://user-images.githubusercontent.com/87826418/156502160-2427e274-c091-472c-b4b1-eb6a54852b45.jpg)
![スクリーンショット 2022-03-03 14 29 07](https://user-images.githubusercontent.com/87826418/156502216-8229becc-d945-441c-b19a-153188b8720e.jpg)


### 画像の投稿画面
画像の投稿は以下のようにタイトル、画像、投稿内容を記述することで投稿可能です。<br>
タグ機能は「#」以下の内容を読み込むようになっています。インスタグラムと同じですね。
![スクリーンショット 2022-03-03 9 40 40](https://user-images.githubusercontent.com/87826418/156473888-16742453-4c50-471a-9295-6248c173098e.jpg)
　　　
   　
    
投稿してみると、確かにフロント画面に投稿内容が表示されました！タグもついています！
![スクリーンショット 2022-03-03 9 42 42](https://user-images.githubusercontent.com/87826418/156474091-a60dd622-a154-441e-a5cb-c4e14f50b179.jpg)
　　
  
  
また、投稿の時にはバリデーションの設定もしており、「タイトル（3文字以上）」、「画像」、「詳細内容」は必須となっています。<br>
何も記述せずに投稿しようとすると以下のようなエラーが表示されるようになっています。
![スクリーンショット 2022-03-03 9 43 58](https://user-images.githubusercontent.com/87826418/156474216-8d2619de-2f66-47ca-a50c-a7952105db80.jpg)


　　　
### 編集画面
![スクリーンショット 2022-02-26 20 54 42](https://user-images.githubusercontent.com/87826418/155842227-29370c0c-aab8-4629-8aae-2232d10892b1.jpg)

### 投稿の削除
間違えて画像を削除しないように、以下の写真のように本当に削除するかを確認するようにしています！
![スクリーンショット 2022-02-26 20 56 13](https://user-images.githubusercontent.com/87826418/155842247-a0a7cf13-cff4-4815-9344-8484e223eae1.jpg)

### タグの検索機能
検索フォームにて、testと検索してみると・・・
![スクリーンショット 2022-03-03 9 36 59](https://user-images.githubusercontent.com/87826418/156473574-3e758dba-f599-40d9-a94d-6aaf422397a2.jpg)
　　
このようにタグにtestを持つ投稿のみ表示されるようになっています！
![スクリーンショット 2022-03-03 9 37 33](https://user-images.githubusercontent.com/87826418/156473623-7d3d7a12-6b91-4e6c-860e-5defbbd4c6f5.jpg)


# 力を入れたところ
storeメソッドに特に力を入れました。<br>
キータでも投稿しましたが、動画で調べたり、サイトで調べたりとにかく画像を投稿できる機能を実装する事にこだわりました。<br>
storeメソッドには画像をpublicフォルダに保存するようにしています。<br>
その実装を外部ライブラリのインストールや設定、シンボリックリンクの作成など動画学習サイトには載っていないものばかりだったので、かなり大変でした。<br>

また、タグの投稿機能も同様に学習サイトにはなかなか載っていなかったので、自分で調べてエラーを解決しての繰り返しでかなり苦労しました！<br>
できた時は流石に「天才...」ってぼそっと言ってしまいました。<br>

以下、app>Http>Controllers>PostControllerの３３行目にあるstoreメソッドの内容になります。
  
```php
 public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $request->image;

        $file = $request->file('image');
        $resized = InterventionImage::make($file)->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save();

        //画像の保存
        Storage::put('public/' . $post->image, $resized);

        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->body, $match);
        $tags = [];

        foreach($match[1] as $tag){
            $found = Tag::firstOrCreate(['tag_name' => $tag]);

            array_push($tags, $found);
        }

        $tag_ids = [];
        foreach($tags as $tag){
            $found = Tag::firstOrCreate(['tag_name' => $tag]);

            array_push($tag_ids, $tag['id']);
        }

        $post->save();
        $post->tags()->attach($tag_ids);

        return redirect()
            ->route('posts.index');
    }
```


# 最後に
まだ完成ではないのですが、今後はCSSで見た目をもっと見やすく、使いたくなるようにする予定です！<br>
またデプロイもしていないのでherokuかAWSを使ってデプロイしようと思います！

# 私について
TwitterとQiitaにて不定期ですが、つぶやきと記事の投稿をしています〜！<br>
Twitterのアカウント→@hiroto_kadota<br>
QiitaのURL→https://qiita.com/Hiroto0706

