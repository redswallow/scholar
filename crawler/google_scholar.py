from urllib import urlencode
import urllib2,cookielib
import time,re
from urllib import FancyURLopener
from random import choice
from BeautifulSoup import BeautifulSoup
from mysqldb import *

user_agents = [
    'Mozilla/5.0 (Windows; U; Windows NT 5.1; it; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11',
    'Opera/9.25 (Windows NT 5.1; U; en)',
    'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
    'Mozilla/5.0 (compatible; Konqueror/3.5; Linux) KHTML/3.5.5 (like Gecko) (Kubuntu)',
    'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.0.12) Gecko/20070731 Ubuntu/dapper-security Firefox/1.5.0.12',
    'Lynx/2.8.5rel.1 libwww-FM/2.14 SSL-MM/1.4.1 GNUTLS/1.2.9'
]

class MyOpener(FancyURLopener, object):
    version = choice(user_agents)

searchurl='http://scholar.google.com/scholar?'
name='Rob A. Rutenbar'
save=1;
data={'hl':'en','q':name}
url_data=urlencode(data)

myopener = MyOpener()
page = myopener.open(searchurl+url_data)
soup=BeautifulSoup(page.read())

title=[];url=[];abstract=[];year=[];cite=[];
results=soup.findAll("h3",{"class":"gs_rt"})
for result in results:
    title.append(result.a.string)
    url.append(result.a['href'])


results=soup.findAll("div",{"class":"gs_rs"})
for result in results:
    contents=''
    for content in result.contents:
        for con in content:
            contents=contents+con
    abstract.append(contents)

results=soup.findAll("div","gs_a")
for result in results:
    contents=''
    for content in result.contents:
        for con in content:
            contents=contents+con
    year.append(re.findall('\d\d\d\d',contents)[0])
    

results=soup.findAll("div",{"class":"gs_fl"})
for result in results:
    cite.append(re.findall('\d+',result.a.string)[0])
    
print len(title),len(abstract),len(year),len(url),len(cite)
if save:
    try:
        conn = MySQLdb.connect(host='localhost', user='root',passwd='901212')
    except Exception,e:
        print e
        sys.exit()
    
    cursor=conn.cursor()
    conn.select_db('scholar');
    l=len(title);
    for i in range(0,l):
        value=[title[i],abstract[i],year[i],url[i],cite[i]]
        sql="insert into paper(title,abstract,year,url,cite) values(%s,%s,%s,%s,%s)"
        count=cursor.execute(sql,value);
        sql="select id from paper where title=%s"
        cursor.execute(sql,title[i])
        for row in cursor.fetchall():
            for r in row: paper_id=r
        sql="select id from author where name=%s"
        cursor.execute(sql,name);
        for row in cursor.fetchall():
            for r in row: author_id=r
        print paper_id,author_id
        value=[paper_id,author_id]
        sql="insert into author_has_paper(paper_id,author_id) values(%s,%s)"
        cursor.execute(sql,value);

    cursor.close();
