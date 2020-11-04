<!-- Twitterのapiの練習。トレンドワードを画面に順次表示させるWebアプリを作成-->

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Description">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .span {
      position: fixed;
    }

    #content {
      width: 100%;
      height: 600px;
    }
  </style>
</head>

<body>
  <h1>twitter上のトレンドワードが順次表示されます。</h1>
  <p>※表示するには「twapi.php」ファイルにtwitter APIを設定します。</p>
  <div id="content"></div>

  <!-- twitter API利用に必要な情報の読み込み -->
  <?php
  require_once 'twapi.php';
  $array = json_encode($names);
  ?>

  <script>
    function setRandomLeft(imageWidth) {
      return (Math.random() * (document.getElementById("content").clientWidth - imageWidth)) + "px";
    }

    function setRandomTop(imageHeight) {
      return (Math.random() * (document.getElementById("content").clientHeight - imageHeight)) + "px";
    }

    let tweet_words = new Object;
    tweet_words.list = JSON.parse('<?php echo $array; ?>');
    tweet_words.count = 0;
    tweet_words.limit = 1000;

    tweet_words.set = function() {
      let span = document.createElement('span');
      span.className = 'span';
      span.style.top = setRandomTop(100);
      span.style.left = setRandomLeft(100);
      span.textContent =
        tweet_words.list[tweet_words.count++];
      document.getElementById('content').appendChild(span);

      if (document.querySelectorAll('span').length >= 50) {
        clearInterval(tweet_words.timer);
      }
    }

    tweet_words.timer = setInterval(tweet_words.set, 1000);
  </script>
</body>

</html>