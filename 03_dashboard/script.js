// 画面サイズを取得
const ScreenWidth = parent.screen.width;
// widthが768pxより小さかったら、サイドバーを隠す
console.log(ScreenWidth);

if (ScreenWidth < 768) {
    $(function () {
        $('#side-bar').hide();
        $('#row1').addClass('position');
    });
}

// トグルボタンが押されたら
$(function(){
    $('#toggle').click(function () {
        // side-barの表示非表示を切り替える
        $('#side-bar').slideToggle();
    });
});

// サイドのメニューボタンが押されたら、トグルを閉じる
$(function(){
    $('.side-menu').click(function () {
        $('#side-bar').slideToggle();
    });
});