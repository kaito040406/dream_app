import csv
import pprint
import time
import re

with open('export7.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    print(row[1])
    row[2] = 0
    with open('changed_data.csv') as c:
      words = csv.reader(c)
      i = 0
      for word in words:
        if word[0] in row[1]:
          if word[1] == 'p':
            row[2] = row[2] + 1
            print('+')
          elif word[1] == 'n':
            row[2] = row[2] - 1
            print('-')
          else:
            print('変動なし')
        else:
          print('該当ワードなし')
        print('STEP'+str(i))
        i = i +1
        # time.sleep(0.02)
      c.close()
    with open('export8.csv', 'a') as e:
      print(str(row[0]) + ',' + str(row[1]) + ',' + str(row[2]) + ',' , file=e)
      e.close()
  f.close()
