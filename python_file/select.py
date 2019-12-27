import csv
import pprint
import time
import re

i = 0
k = 0
datas = []
with open('export5.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    datas.append(row[1])
    for data in datas:
      if row[1] in data:
        k = k + 1
    if k <= 1:
      with open('export6.csv', 'a') as e:
        print(row[0] + ',' + row[1] + ',' + row[2] + ',', file=e)
        e.close()
    k = 0
    i = i + 1
  f.close()