--Books�e�[�u������
Create Table books (
id INT AUTO_INCREMENT NOT NULL
	,title VARCHAR(50)
	,date date
	,stock INT
	,PRIMARY KEY (Id));
	
--users�e�[�u��
Create Table users (
id INT AUTO_INCREMENT NOT NULL
	,name VARCHAR(50)
	,password VARCHAR(255)
	,PRIMARY KEY (Id));

