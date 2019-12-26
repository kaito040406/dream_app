import re
import sys
import time

pattern=re.compile('	+')
fout=open('changed_data.csv', 'tw')
with open('word_date.csv', 'tr') as fin:
  for ilne in fin:
    fout.write(pattern.sub(',', ilne))
    print(ilne)
    time.sleep(0.2)
  fin.close()
