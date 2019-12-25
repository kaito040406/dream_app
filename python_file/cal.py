import csv
import pprint
import time

with open('uranai.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    print(row)
    time.sleep(1)
