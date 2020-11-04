<!-- 会員情報登録画面の練習.liteSQL or MySQLを使用します -->


<?php
require_once './css/Encode.php';
session_start();
$token = create_token();
insert_session($token);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Description">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        dl dt {
            float: left;
            padding: 1em;
            color: #998484;
        }

        dl dd {
            border-bottom: 1px solid #cccccc;
            margin: 0;
            padding: 1em 0 1em 10em;
        }

        dl dd input {
            width: 18em;
        }
    </style>
</head>

<body class="container">
    <h2>お客様情報入力画面</h2>
    <form action="shopping_form_check.php" method="post">
        <input type="hidden" name="token" value="<?php print($token); ?>">
        <dl>
            <dt>お名前</dt>
            <dd><input type="text" name="name" maxlength="30" required></dd>
            <dt>メールアドレス</dt>
            <dd><input type="email" name="email" maxlength="30"></dd>
            <dt>郵便番号</dt>
            <dd><input type="tel" name="postal_code1" style="width: 4em" maxlength="3" minlength="3">ー<input type="tel" name="postal_code2" style="width: 5em" minlength="4" maxlength="4" required></dd>
            <dt>住所</dt>
            <dd><input type="text" name="address" minlength="10" maxlength="50" required></dd>
            <dt>電話番号</dt>
            <dd><input type="tel" name="tel" maxlength="11" minlength="11" required></dd>
        </dl>

        <p>
            <label><input type="radio" name="chumon" value="konkai" style="margin:0 1em 0 0" checked>今回だけの注文</label><br>
            <label><input type="radio" name="chumon" value="touroku" style="margin:0 1em 0 0">会員登録しての注文</label><br>
            <span style="color: brown; margin:0 0 0 1em">※会員登録する方は、以下の項目も入力してください。</span>
        </p>
        <p></p>
        <h4>会員登録</h4>
        <dl>
            <dt>パスワード</dt>
            <dd><input type="password" name="pass1" minlength="8" maxlength="16"></dd>
            <dt>パスワード（もう一度入力してください）</dt>
            <dd><input type="password" name="pass2" minlength="8" maxlength="16"></dd>
            <dt>性別</dt>
            <dd style="padding: 1em 0 1em 5em">
                <label><input type="radio" name="gender" value="man">男性</label>
                <label><input type="radio" name="gender" value="woman">女性</label>
                <label><input type="radio" name="gender" value="other">その他</label></dd>
            <dt>生まれ年</dt>
            <dd><select name="birth">
                <option value="" selected>年代を選んでください</option>
                    <?php for ($i = 2010; $i >= 1910; $i -= 10) {
                        print('<option value="' . $i . '">' . $i . '年代</option>');
                    } ?>
                </select></dd>
        </dl>

        <input type="submit" value="OK" class="btn btn-primary" style="width:5em">
        <input type="button" value="戻る" onclick="history.back()" class="btn btn-primary" style="width:5em">
        <p></p>
    </form>
</body>

</html>