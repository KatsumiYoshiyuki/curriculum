let numbers = [2, 5, 12, 13, 15, 18, 22];
var num = 0;
for(i=0;i <= numbers.length - 1;i++){
	num = numbers[i];
	if(num%2 == 0){
		isEven();
	}
}
function isEven() {
    console.log(num + 'は偶数です');
}