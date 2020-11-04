<?php
require_once './css/Encode.php';
session_start();
token_catch();
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
    <h2>確認画面</h2>

    <?php

    $post = sanitize($_POST);
    $name = $post['name'];
    $email = $post['email'];
    $postal_code1 = $post['postal_code1'];
    $postal_code2 = $post['postal_code2'];
    $address = $post['address'];
    $tel = $post['tel'];
    $chumon = $post['chumon'];
    $pass1 = $post['pass1'];
    $pass2 = $post['pass2'];
    $gender = $post['gender'];
    $birth = $post['birth'];

    ?>


    <form action="shopping_form_done.php" method="post">
        <input type="hidden" name="token" value="<?php print($token); ?>">
        <dl>
            <dt>お名前</dt>
            <dd><?php print($name); ?></dd>
            <dt>メールアドレス</dt>
            <dd><?php print($email); ?></dd>
            <dt>郵便番号</dt>
            <dd><?php print($postal_code1); ?>ー<?php print($postal_code2); ?></dd>
            <dt>住所</dt>
            <dd><?php print($address); ?></dd>
            <dt>電話番号</dt>
            <dd><?php print($tel); ?></dd>

            <input type="hidden" name="name" value="<?php print($name); ?>">
            <input type="hidden" name="email" value="<?php print($email); ?>">
            <input type="hidden" name="postal_code1" value="<?php print($postal_code1); ?>">
            <input type="hidden" name="postal_code2" value="<?php print($postal_code2); ?>">
            <input type="hidden" name="address" value="<?php print($address); ?>">
            <input type="hidden" name="tel" value="<?php print($tel); ?>">
            <input type="hidden" name="chumon" value="<?php print($chumon); ?>">
            <input type="hidden" name="pass1" value="<?php print($pass1); ?>">
            <input type="hidden" name="gender" value="<?php print($gender); ?>">
            <input type="hidden" name="birth" value="<?php print($birth); ?>">

            <dt>会員登録</dt>
            <?php if ($chumon == 'konkai') { ?>
                <dd>今回のみの注文</dd>
            <?php } else { ?>
                <dd>会員登録しての注文</dd>
            <?php } ?>

            <?php
            $okflog = true;
            if ($chumon == 'touroku') {
                if (!isset($pass1)) { ?>
                    <p>
                        <div class="alert alert-primary" role="alert">
                            パスワードが入力されていません。
                        </div>
                    </p>1

                <?php $okflog = false;
                } else if ($pass1 != $pass2) { ?>
                    <p>
                        <div class="alert alert-primary" role="alert">
                            パスワードが一致しません。
                        </div>
                    </p>
                <?php $okflog = false;
                } else {
                ?>
                    <dt>パスワード</dt>
                    <dd> ※非表示</dd>
                    <dt>性別</dt>
                    <dd> <?php
                            switch ($gender) {
                                case 'man':
                                    print('男性');
                                    break;
                                case 'woman':
                                    print('女性');
                                    break;
                                case 'other':
                                    print('その他');
                                    break;
                            }  ?>
                    </dd>
                    <dt>生まれ年</dt>
                    <dd><?php print($birth); ?>　</dd>

            <?php }
            } ?>
        </dl>
        <?php if ($okflog) { ?>
            <input type="submit" value="注文確定" class="btn btn-primary" style="width:8em">
        <?php } ?>
        <input type="button" value="戻る" onclick="history.back()" class="btn btn-primary" style="width:5em">
    </form>
</body>

</html>