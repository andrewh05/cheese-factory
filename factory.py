from tkinter import *
from datetime import *
from datetime import datetime
from tkinter import  ttk
import mysql.connector
from tkinter.messagebox import *


test = ""

class product:
    def __init__(self):
        self.cn = mysql.connector.connect(host='localhost',
                                            database='Factory',
                                            user='root',
                                            password='')
        self.cr = self.cn.cursor()
        win.protocol("WM_DELETE_WINDOW", self.Quit)

    def Quit(self):
        self.cn.close()
        win.destroy()

    def is_num(self, x):
        try:
            float(x)
            return True
        except ValueError:
            return False

    def Val_Date(self, date_str):
        try:
            expiry_date = datetime.strptime(date_str, "%d-%m-%Y")
            if expiry_date > datetime.now():
                return True
            else:
                return False
        except ValueError:
            return False

    def convert_to_db_date(self, date_str):
        try:
            expiry_date = datetime.strptime(date_str, "%d-%m-%Y")
            return expiry_date.strftime("%Y-%m-%d")
        except ValueError:
            return None

    def Clear(self):
        vr1.set("")
        vr2.set("")
        vr3.set("")
        vr4.set("")
        cb.set("Select")
        v1.set("Fat Free")
        e1.focus()

    def Save(self):
        s1 = e1.get()
        s2 = e2.get()
        s3 = e3.get()
        s4 = e4.get()
        s5 = v1.get()
        s6 = cb.get()

        converted_expiry_date = self.convert_to_db_date(s4)

        var1 = True
        var2 = True
        var3 = True

        if not self.is_num(s3):
            showinfo('Cheese factory', 'Check for numbers in your inputs')
            var1 = False
            return

        if not self.Val_Date(s4):
            showinfo('Cheese factory', 'Check for date in your inputs')
            var2 = False
            return

        if not converted_expiry_date:
            showinfo('Cheese factory', 'Check for errors in your inputs')
            var3 = False
            return

        if var1 and var2 and var3 == True:
            try:
                sb = '''insert into Product (Code, Descrip, Catg, Type, Qtty, Exp_Date) values(%s, %s, %s, %s, %s, %s) '''
                value = (s1, s2, s6, s5, s3, converted_expiry_date)
                self.cr.execute(sb, value)
                self.cn.commit()
                self.Clear()
                showinfo('Cheese factory', 'DATA SAVED')
            except ValueError:
                showinfo('Cheese factory', 'ERROR!!!')
        else:
            showinfo('Cheese factory', 'UNKOWN ERROR!!')

    def View_One(self):
        s1 = e1.get()

        sq = 'select * from product where code = %s '
        self.cr.execute(sq, (s1,))
        try:
            rd = self.cr.fetchone()
            vr1.set(rd[0])
            vr2.set(rd[1])
            cb.set(rd[2])
            v1.set(rd[3])
            vr3.set(rd[4])
            vr4.set(rd[5])

        except:
            showinfo('Cheese factory', 'NOT FOUND')

    def Delete(self):
        s1 = e1.get()

        sq = '''delete from product where code = %s'''
        self.cr.execute(sq, (s1,))
        self.cn.commit()
        self.Clear()
        showinfo('Cheese factory', 'DATA DELETED')

    def Update(self):
        s1 = e1.get()
        s2 = e2.get()
        s3 = e3.get()
        s4 = e4.get()
        s5 = v1.get()
        s6 = cb.get()

        converted_expiry_date = self.convert_to_db_date(s4)

        var1 = True
        var2 = True
        var3 = True

        if not self.is_num(s3):
            showinfo('Cheese factory', 'Check for numbers in your inputs')
            var1 = False
            return


        if var1 == True:
            try:
                sb = '''update product set Descrip = %s, Catg = %s, Type = %s, Qtty = %s, Exp_Date = %s where Code = %s'''
                value = (s2, s6, s5, s3, converted_expiry_date, s1)
                self.cr.execute(sb, value)
                self.cn.commit()
                self.Clear()
                showinfo('Cheese factory', 'DATA UPDATED')
            except ValueError:
                showinfo('Cheese factory', 'ERROR!!!')
        else:
            showinfo('Cheese factory', 'UNKNOWN ERROR')






win = Tk()
win.geometry('500x500')
win.resizable(0,0)

date = date.today()
data = ['soft', 'semi-soft', 'semi-hard', 'hard']

v1 = StringVar()

lb1 = Label(win, text="Cheese Factory", font=('Arial',16))
lb2 = Label(win, text="Date:")
lb3 = Label(win, text=date.strftime("%d %B %Y"))

vr1 = StringVar()
vr2 = StringVar()
vr3 = StringVar()
vr4 = StringVar()

lb4 = Label(win, text="Code", font=('Arial', 10))
e1 = Entry(win, textvariable=vr1)
lb5 = Label(win, text="Description", font=('Arial', 10))
e2 = Entry(win, textvariable=vr2)
lb6 = Label(win, text="Category", font=('Arial', 10))
cb = ttk.Combobox(win , state='readonly', values= data)
cb.set('Select')

f1 = LabelFrame(win, text='Type')
c1 = Radiobutton(f1, text='Fat Free', variable=v1, value="Fat Free")
c2 = Radiobutton(f1, text='Low Fat', variable=v1, value="Low Fat")
c3 = Radiobutton(f1, text='Full Fat', variable=v1, value="Full Fat")
v1.set('Fat Free')

lb7 = Label(win, text="Quantity", font=('Arial', 10))
e3 = Entry(win, textvariable=vr3)
lb8 = Label(win, text="Epiry Date", font=('Arial', 10))
lb9 = Label(win, text="(dd-mm-yyyy)", font=('Arial', 10))
e4 = Entry(win, textvariable=vr4)

vd = product()

bt1 = Button(win, text="Clear", width=10, height=2, fg="red", command=vd.Clear)
bt2 = Button(win, text="View One", width=10, height=2, fg="green", command=vd.View_One)
bt3 = Button(win, text="Save", width=10, height=2, fg="green", command=vd.Save)
bt4 = Button(win, text="Delete", width=10, height=2, fg="green", command=vd.Delete)
bt5 = Button(win, text="Update", width=10, height=2, fg="green", command=vd.Update)

lb1.place(x=170,y=20)
lb2.place(x=310,y=60)
lb3.place(x=350,y=60)

lb4.place(x=40, y=100)
e1.place(x=130,y=100)
lb5.place(x=40, y=140)
e2.place(x=130,y=140)
lb6.place(x=40, y=180)
cb.place(x=130, y=180)

f1.place(x=130, y=230)
c1.pack(anchor = CENTER)
c2.pack(anchor = CENTER)
c3.pack(anchor = CENTER)

lb7.place(x=40,y=350)
e3.place(x=130, y=350)
lb8.place(x=40,y=400)
lb9.place(x=40,y=420)
e4.place(x=130,y=400)

bt1.place(x=360, y=100)
bt2.place(x=360, y=150)
bt3.place(x=360, y=200)
bt4.place(x=360, y=250)
bt5.place(x=360, y=300)

win.mainloop()
