import csv
import pprint
import time
import re


with open('uranai.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    katakana_word = re.findall("[ァ-ン]", row[1])
    kanji_word = re.findall("[一-龥]", row[1])
    print(row[0])
    print(katakana_word)
    print(kanji_word)
    time.sleep(1)
