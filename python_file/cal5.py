import csv
import pprint
import time
import re

# with open('export6.csv') as f:
#   reader = csv.reader(f)
#   for row in reader:
#     with open('changed_data.csv') as c:
#       words = csv.reader(c)
#       i = 0
#       with open('changed_data_edit1.csv', 'a') as e:
#         for word in words:
#           if word[0] in row[1]:
#             print(word[0] + ',' + word[1] + ',', file=e)
#         i = i +1
#         e.close()
#       c.close()
#   f.close()

i = 0
datas = []
with open('changed_data_edit1.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    datas.append(row)
    i = i + 1
  f.close()
  print(len(datas))
  for data in datas:
    with open('changed_data_edit2.csv') as e:
      reader2 = csv.reader(e)
      j = 0
      for row2 in reader2:
        if data[0] == row2[0]:
          j = j + 1
      e.close()

    print(j)
    if j == 0:
      k = 0
      for index in range(len(datas)):
        if data == datas[index]:
          k = k + 1
      with open('changed_data_edit3.csv', 'w') as w:
        print(data[0] + ',' + data[1] + ',' + str(k) + ',', file=w)
        w.close()
        
      with open('changed_data_edit3.csv') as q:
        reader3 = csv.reader(q)
        with open('changed_data_edit2.csv', 'a') as u:
          for row3 in reader3:
            print(row3[0] + ',' + row3[1] + ',' + row3[2] + ',', file=u)
          u.close()
        q.close()

