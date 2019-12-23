import requests
import time
from bs4 import BeautifulSoup
 
def Detail_page(url):
  print(url)
  d_r = requests.get(url)
  d_soup = BeautifulSoup(d_r.content, "html.parser")
  d_datas_title = d_soup.select(".section content_ln header_ln header2_ln", recursive=False)
  d_datas_text = d_soup.select(".content_ln", recursive=False)

  for d_data_title in d_datas_title:
    title = d_data_title.text
    print(title)

  for d_data_text in d_datas_text:
    text = d_data_text.text
    print(text)



r = requests.get('https://spicomi.net/media/articles/1540')
soup = BeautifulSoup(r.content, "html.parser")
datas = soup.select(".content_ln", recursive=False)
for data in datas:
  datas2 = data.select("a")
  if len(datas2) != 0:
    for data2 in datas2:
      # url = data2.get("href")
      # print(data2.get("href"))
      Detail_page(data2.get("href"))
      time.sleep(60)




 
