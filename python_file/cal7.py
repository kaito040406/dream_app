import csv
import pprint
import time
import re


with open('word_data2.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    if row[1] == "p":
      with open('export14.csv', 'a') as e:
        print(row[0] + ',' + row[1] + ',' + '1' , file=e)
        e.close()
    elif row[1] == "n":
      with open('export14.csv', 'a') as e:
        print(row[0] + ',' + row[1] + ',' + '-1' , file=e)
        e.close()
  f.close()
