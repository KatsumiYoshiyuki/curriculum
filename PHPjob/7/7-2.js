class Car{

	constructor(gasolin,number){
		this.gasolin = gasolin;
		this.number = number;
	}

	getNumgas(){
		console.log("ガソリンは" + this.gasolin + "です。ナンバーは" + this.number + "です");
	}

}

cartype = new Car("ハイオク","あ 20-20");
cartype.getNumgas();