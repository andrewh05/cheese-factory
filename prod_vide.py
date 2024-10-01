from tkinter import *
from datetime import *
from tkinter import  ttk

win = Tk()
win.geometry('500x500')
win.resizable(0,0)

date = date.today()
data = ['soft', 'semi-soft', 'semi-hard', 'hard']

v1 = StringVar()

lb1 = Label(win, text="Cheese Factory", font=('Arial',16))
lb2 = Label(win, text="Date:")
lb3 = Label(win, text=date.strftime("%d %B %Y"))

lb4 = Label(win, text="Code", font=('Arial', 10))
e1 = Entry(win)
lb5 = Label(win, text="Description", font=('Arial', 10))
e2 = Entry(win)
lb6 = Label(win, text="Category", font=('Arial', 10))
cb = ttk.Combobox(win , state='readonly', values= data)
cb.set('Select')

f1 = LabelFrame(win, text='Type')
c1 = Radiobutton(f1, text='Fat Free', variable=v1, value="Fat Free")
c2 = Radiobutton(f1, text='Low Fat', variable=v1, value="Low Fat")
c3 = Radiobutton(f1, text='Full Fat', variable=v1, value="Full Fat")
v1.set('Fat Free')

lb7 = Label(win, text="Quantity", font=('Arial', 10))
e3 = Entry(win)
lb8 = Label(win, text="Epiry Date", font=('Arial', 10))
lb9 = Label(win, text="(dd-mm-yyyy)", font=('Arial', 10))
e4 = Entry(win)

bt1 = Button(win, text="Clear", width=10, height=2, fg="red")
bt2 = Button(win, text="View One", width=10, height=2, fg="green")
bt3 = Button(win, text="Save", width=10, height=2, fg="green")
bt4 = Button(win, text="Delete", width=10, height=2, fg="green")
bt5 = Button(win, text="Update", width=10, height=2, fg="green")

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
