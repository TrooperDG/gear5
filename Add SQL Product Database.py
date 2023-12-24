import os, random, string, pymysql

con = pymysql.connect(host="localhost", user="root", password="shree", database="gear5")
cur = con.cursor()
path = "C:\\Personal Files\\RoadToDev\\xampp\\htdocs\\gear5\\gear5-ex-2\\products_image"
os.chdir(path)
files = os.listdir(path)
for image in files:
    c = 0
    iid = ""
    for i in random.choices(string.ascii_uppercase + string.digits, k=20):
        if c % 5 == 0 and c != 0:
            iid += "-" + i
        else:
            iid += i
        c += 1
    print("---------" + image + " : " + iid + "---------")
    name = input("Name: ")
    if name == '':
        continue
    price = float(input("Price: "))
    star = float(input("Stars: "))
    count = int(input("Count: "))
    sql = f"insert into products (id, name, image, price, review_stars, review_count) values ('{iid}', '{name}', 'product_images/{image}', {price}, {star}, {count});"
    cur.execute(sql)
    con.commit()
    print("Added!")
