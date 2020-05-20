/**
 * format display money
 * param: value money, format default 
 */
function formatDisplayMoney(money, last = ''){
    money = String(money);
    let lengthMoney = money.length;
    let arrayMoney = money.split('').reverse();
    if (lengthMoney > 3){
        for (let i = 3 ; i < lengthMoney; i+=3){
            for(let j = lengthMoney ; j > i ; j--){
                arrayMoney[j] = arrayMoney[j - 1];
            }
            arrayMoney[i] = '.';
            lengthMoney = lengthMoney + 1;
            i++;
        }
        arrayMoney =  arrayMoney.reverse().join('');
        return arrayMoney + last;
    }
    return money + last;
}
/**
 * chuyển số tiền sang dạng chữ
 * param: số tiền
 */
function ChangeMoneyToString(money){
    const ChuSo = [" không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín "];
    const Tien =  ["", " nghìn", " triệu"];
    console.log(money)
}