--Booksテーブル生成
Create Table books (
id INT AUTO_INCREMENT NOT NULL
	,title VARCHAR(50)
	,date date
	,stock INT
	,PRIMARY KEY (Id));
	
--usersテーブル
Create Table users (
id INT AUTO_INCREMENT NOT NULL
	,name VARCHAR(50)
	,password VARCHAR(255)
	,PRIMARY KEY (Id));

