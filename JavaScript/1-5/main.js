//①関数名を適切なものに変えてください
//②仮引数を適切なものに変えてください
function createJuice(fruits) {
    //③「〇〇を受け取りました。ジュースにして返します」と出力
console.log(fruits + 'を受け取りました。ジュースにして返します');
    //④受け取った果物にジュースという文字列を結合して、呼び出し元に返す
    return fruits + 'ジュース';
}
//⑤関数の実行：「みかん」を渡して、結果を受け取れるように適当な変数（orangeJuice）を用意
let orangeJuice = createJuice('みかん');
//⑥返ってきた変数を利用して「〇〇が届きました」と出力する
console.log(orangeJuice + 'が届きました');