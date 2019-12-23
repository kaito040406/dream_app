import requests
import time
from bs4 import BeautifulSoup
 
def Detail_page(url):
  print(url)
  d_r = requests.get(url)
  d_soup = BeautifulSoup(d_r.content, "html.parser")
  d_datas_text = d_soup.select(".content_ln", recursive=False)
  last = int(len(d_datas_text)) - 3
  k = 0

  for d_data_text in d_datas_text:
    if  k >= 3 and k <= last:
      text = d_data_text.text
      print(k)
      print(text)
    k = k + 1
    

r = requests.get('https://spicomi.net/media/articles/1540')
soup = BeautifulSoup(r.content, "html.parser")
datas = soup.select(".content_ln", recursive=False)
for data in datas:
  datas2 = data.select("a")
  if len(datas2) != 0:
    for data2 in datas2:
      Detail_page(data2.get("href"))
      time.sleep(5)




 
