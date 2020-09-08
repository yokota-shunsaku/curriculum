function myfunc() {

    // idが「target」の要素を取得して、変数changeに代入
    let change = document.getElementById('target');

    // textContentを使って「こんにちは」で書き変える
    change.textContent = 'こんにちは!';
}