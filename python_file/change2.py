import csv
import pprint
import time
import re


with open('export4.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    with open('export5.csv', 'a') as e:
      print(row[1] + ',' + row[2] + ',' + row[3] + ',', file=e)
      e.close()
  f.close()
