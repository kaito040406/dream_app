import requests
from bs4 import BeautifulSoup
 
r = requests.get('https://spicomi.net/media/articles/1540')
# r = requests.get("https://news.yahoo.co.jp/")
soup = BeautifulSoup(r.content, "html.parser")
# print(data.find("content_ln").text)
datas = soup.select(".content_ln", recursive=False)
for data in datas:
  data2 = data.select("a")
  if len(data2) != 0:
    print(data2)


 
