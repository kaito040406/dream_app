import csv
import pprint
import time
import re


with open('export8.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    with open('export9.csv', 'a') as e:
      edit = int(row[3])-3
      print(row[1] + ',' + row[2] + ',' + str(edit) + ',', file=e)
      e.close()
  f.close()
