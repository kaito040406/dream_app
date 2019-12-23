import requests
from bs4 import BeautifulSoup
 
r = requests.get('https://spicomi.net/media/articles/1540')
# r = requests.get("https://news.yahoo.co.jp/")
soup = BeautifulSoup(r.content, "html.parser")
# print(data.find("content_ln").text)
datas = soup.select(".content_ln", recursive=False)
for data in datas:
  datas2 = data.select("a")
  if len(datas2) != 0:
    # for data3 in data2:
    # print(data2.get("href"))
    for data2 in datas2:
      url = data2.get("href")


 
