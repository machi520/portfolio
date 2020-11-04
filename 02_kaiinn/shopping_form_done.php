<?php
require_once './css/Encode.php';
session_start();
// token_catch();


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
    <h2>ご注文が確定しました</h2>
    <p>ご注文ありがとうございました。<br>
        ご登録されたメールアドレスに、ご注文確定のメールを送信しましたので、ご確認下さい。<br>
        商品はご登録いただきましたご住所へ発送させていただきます。
    </p>
    <p><br></p>
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
    $gender = $post['gender'];
    $birth = $post['birth'];
    ?>
    <h3>お客様情報</h3>
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
        <?php if ($chumon == 'touroku') {   ?>

            <dt>会員登録</dt>
            <?php if ($chumon == 'konkai') { ?>
                <dd>今回のみの注文</dd>
            <?php } else { ?>
                <dd>
                    <p>会員登録しての注文</p>
                    <p>会員登録が完了しました。<br>
                        次回よりご登録いただいたメールアドレスとパスワードでログインしてください。<br>「かんたん注文」システムをご利用になれます。</p>
                </dd>
            <?php }  ?>
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
                        default:
                            print('　');
                    }  ?>
            </dd>
            <dt>生まれ年</dt>
            <dd><?php print($birth); ?>　</dd>
        <?php } ?>
    </dl>
    <p><br></p>
    <h3>ご注文内容</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">商品</th>
                <th scope="col">価格</th>
                <th scope="col">数量</th>
                <th scope="col">小計</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $honbun = '';
                $honbun .= $name . "様\n\nこの度は御注文ありがとうございました。\n";
                $honbun .= "\n";
                $honbun .= "御注文商品\n";
                $honbun .= "-----------------\n";

                $cart = $_SESSION['cart'];
                $number = $_SESSION['number'];
                $max = count($cart);

                $db = new PDO($dsn, $db_user, $db_pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                $sql = 'LOCK TABLES date_sales WRITE, dat_salses_product WRITE, mst_product WRITE,dat_member WRITE';
                $stmt = $db->prepare($sql);
                $stmt->execute();

                $lastmembercode = 0;
                if ($chumon == 'touroku') {
                    $sql = 'INSERT INTO dat_member (password,name,email,postal1,postal2,address,tel,gender,birth) VALUES (?,?,?,?,?,?,?,?,?);';
                    $stmt = $db->prepare($sql);
                    $m_pass = password_hash($pass1, PASSWORD_DEFAULT);
                    $data = array($m_pass, $name, $email, $postal_code1, $postal_code2, $address, $tel);
                    switch ($gender) {
                        case 'man':
                            $data[] = 1;
                            break;
                        case 'woman':
                            $data[] = 2;
                            break;
                        case 'other':
                            $data[] = 3;
                            break;
                        default:
                            $data[] = 0;
                    }
                    $data[] = $birth;
                    $stmt->execute($data);

                    $sql = 'SELECT LAST_INSERT_ID();';
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    $lastmembercode = $rec['LAST_INSERT_ID()'];
                }
                $data = array();
                $goukei;
                $kakaku = array();

                for ($i = 0; $i < $max; $i++) {
                    $sql = 'SELECT name,price FROM mst_product WHERE code=?';
                    $stmt = $db->prepare($sql);
                    $data[0] = $cart[$i];
                    $stmt->execute($data);

                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    $pname = $rec['name'];
                    $price = $rec['price'];
                    $kakaku[] = $price;
                    $suryo = $number[$i];
                    $shokei = $price * $suryo;
                    $goukei += $shokei;

                    print('<tr>');
                    print('<td >' . $pname . '</td>');
                    print('<td>' . $price . '円</td>');
                    print('<td>' . $suryo . '個</td>');
                    print('<td>' . $shokei . '円</td>');
                    print('</tr>');

                    $honbun .= $pname . ' ';
                    $honbun .= $price . '円×';
                    $honbun .= $suryo . '個=';
                    $honbun .= $shokei . "円\n";
                }

                $sql = 'INSERT INTO date_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
                $stmt = $db->prepare($sql);
                $data = array($lastmembercode, $name, $email, $postal_code1, $postal_code2, $address, $tel);
                $stmt->execute($data);

                $sql = 'SELECT LAST_INSERT_ID()';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $lastcode = $rec['LAST_INSERT_ID()'];

                for ($i = 0; $i < $max; $i++) {
                    $sql = 'INSERT INTO dat_salses_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
                    $stmt = $db->prepare($sql);
                    $data = array();
                    $data[] = $lastcode;
                    $data[] = $cart[$i];
                    $data[] = $kakaku[$i];
                    $data[] = $number[$i];
                    $stmt->execute($data);
                }
                $sql = 'UNLOCK TABLES';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $db = null;

                $honbun .= "送料は無料です\n";
                $honbun .= "----------------\n";
                $honbun .= "\n";
                $honbun .= "代金は以下の口座にお振込みください。";
                $honbun .= "ろくまる銀行　野菜支店　普通口座　1234567\n";
                $honbun .= "入金が確認取れ次第、梱包、発送させていただきます。\n";
            } catch (Exception $e) {
                exit('エラーが発生しました：' . $e->getMessage());
            }
            ?>
        </tbody>
        <p>合計：<?php print($goukei); ?>円</p>
    </table>

    <p></p>

    <h3>メール送信の内容</h3>
    <?php print nl2br($honbun);

    // $title ='ご注文ありがとうございます。';
    // $header='From:info@rokumaru.co.jp';
    // $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    // mb_language('Japanese');
    // mb_internal_encoding('UTF-8');
    // mb_send_mail($email,$title,$honbun,$header);

    clear_session();
    ?>

    <a href="shopping_list.php"><input type="button" value="商品一覧へ戻る" class=" btn btn-primary" style="width:10em"></a>
    <p></p>
</body>

</html>