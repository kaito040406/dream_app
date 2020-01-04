import csv
import pprint
import time
import re

sum = 0
i = 0
back_max = -100
back_min = 100
num_count = 0
# with open('export.csv') as f:
#   reader = csv.reader(f)
#   for row in reader:
#     edit = int(row[2]) - 3
#     with open('export4.csv', 'a') as e:
#       print(row[0] + ',' + row[1] + ',' + str(edit) + ',', file=e)
#       e.close()

#   f.close()

# with open('export.csv') as f:
#   reader = csv.reader(f)
#   for row in reader:
#     if float(row[2]) < back_min:
#       back_min = float(row[2])
#   f.close()

# print(back_max)
# print(back_min)

# center = (back_max + back_min) / 2

# print(center)
# ave = sum / i
# print(ave)
for count in range(-30, 30):
  with open('export6.csv') as f:
    reader = csv.reader(f)
    for row in reader:
      if str(count) in row[2]:
        num_count = num_count + 1
    f.close()
  # print(str(count) + "   " + str(num_count))
  with open('export3.csv', 'a') as e:
    print(str(count) + ',' + str(num_count) + ',' , file=e)
    e.close()
  num_count = 0