import csv
import pprint
import time
import re


with open('export6.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    if row[2] == 1:
      with open('export10.csv', 'a') as e:
        print(row[0] + ',' + row[1] + ',' + row[2] + ',', file=e)
        e.close()
  f.close()
