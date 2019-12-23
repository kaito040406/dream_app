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
  i = 0
  coulmn = {}

  for d_data_text in d_datas_text:
    if  k >= 3 and k <= last:
      if k % 2 == 1:
        coulmn = {"title" : d_data_text.text}
      elif k % 2 == 0:
        coulmn.update({"text" : d_data_text.text})
        i = i + 1
        with open('uranai.csv', 'a') as f:
          print(str(coulmn["title"]) + ",", str(coulmn["text"]) + "," , file=f)
          f.close()
        coulmn = {}
      print("取得完了")
      time.sleep(0.5) 
      # text = d_data_text.text
      # print(text)
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




 
