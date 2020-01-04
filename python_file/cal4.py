import csv
import pprint
import time
import re

with open('export10.csv') as f:
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
            print(word[0])
            print("---------------")
          elif word[1] == 'n':
            row[2] = row[2] - 1
            print('-')
            print(word[0])
            print("---------------")
          else:
            print('変動なし')
            print(word[0])
            print("---------------")
        # else:
          # print('該当ワードなし')
        # print('STEP'+str(i))
        i = i +1
        # time.sleep(0.01)
      c.close()
      time.sleep(10)
    with open('export11.csv', 'a') as e:
      print(str(row[0]) + ',' + str(row[1]) + ',' + str(row[2]) + ',' , file=e)
      e.close()
  f.close()
