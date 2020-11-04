<article class="post">
    <div class="container">
        <ol class="bread">
            <li><a href="#">TOP</a></li>
            <li><a href="#">CONTENTS</a></li>
            <li><a href="#">CONTENT A</a></li>
        </ol>
        <h1> contentA title</h1>
        <h2>articles title</h2>
        <!-- 素材元：AC写真 素材ID：297171 作者：サンサン -->
        <span class="img"><img src="img/297171_s.jpg" alt=""></span>

        <p> sample articles. sample articles. sample articles. sample articles. sample articles.<br>
            sample articles. sample articles. sample articles. sample articles.sample articles.</p>
        <!-- articleA -->
        <h3>articleA</h3>
        <!-- ラジオボタンを選択すると表示するコンテンツ練習。
        クイズサイトなどの想定。Q＆Aなど。 -->
        <form action="#" name="">
            <label><input type="radio" name="Q1" class="Q1">row1</label>
            <label><input type="radio" name="Q1" class="Q1">row2</label>
            <label><input type="radio" name="Q1" class="Q1">row3</label>
        </form>

        <div class="A1 display">
            <p> sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA. sample articleA.</p>

            <!-- pictgram -->
            <div class="graph">
                <table>
                    <tr>
                        <th>row1</th>
                        <td>10人</td>
                        <td>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <i class="fas fa-child"></i>
                                <?php if ($i % 10 == 0) { ?>
                                    <br>
                            <?php }
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>row2</th>
                        <td>20人</td>
                        <td>
                            <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <i class="fas fa-child"></i>
                                <?php if ($i % 10 == 0) { ?>
                                    <br>
                            <?php }
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>row3</th>
                        <td>30人</td>
                        <td>
                            <?php for ($i = 1; $i <= 30; $i++) { ?>
                                <i class="fas fa-child"></i>
                                <?php if ($i % 10 == 0) { ?>
                                    <br>
                            <?php }
                            } ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="syutten"><span>出典：TEST</span></div>
            <p></p>
        </div>
</article>