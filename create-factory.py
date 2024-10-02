import mysql.connector
cn = mysql.connector.connect( host='localhost',
                            user='root',
                            password='' )

cr = cn.cursor()

sq = 'create database Factory'
cr.execute(sq)

sq1 = sq = '''create table Factory.Product 
                ( Code varchar(10) not null,
                Descrip varchar(30) not null,
                Catg varchar(20) not null,
                Type varchar(30) not null,
                Qtty int not null,
                Exp_Date date not null,
                primary key (code) ) '''

cr.execute(sq1)


cn.close()
