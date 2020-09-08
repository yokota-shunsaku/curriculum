let numbers = [2, 5, 12, 13, 15, 18, 22];
//ここに答えを実装してください。↓↓↓
for (let num = 0; num < numbers.length; num++) {
if (numbers[num] % 2 === 0) {
    isEven(numbers[num]);
}
}
    function isEven(num) {
    console.log(num + 'は偶数です');
}




class Car {

    constructor(gass, num) {
        this.gass = gass;
        this.num = num;
    }

    getNumGas() {
        console.log(`ガソリンは${this.gass}です。ナンバーは${this.num}です`);
    }
}

let mario = new Car('満タン', '1111');
mario.getNumGas();
let luigi = new Car('半分', '2222');
luigi.getNumGas();