import csv
import pprint
import time
import re

with open('export12.csv') as c:
  words = csv.reader(c)
  i = 0
  p = 0
  n = 0
  e = 0
  with open('export13.csv', 'a') as u:
    for word in words:
      if int(word[2]) <= 1:
        edit = int(word[2])-2
        print(edit)
        print(word[0] + ',' + word[1] + ',' + str(edit) + ',', file=u)
      elif int(word[2]) >= 2:
        edit = int(word[2])-1
        print(edit)
        print(word[0] + ',' + word[1] + ',' + str(edit) + ',', file=u)
      else:
        print('変動なし')
      i = i +1
    u.close()
  c.close()

