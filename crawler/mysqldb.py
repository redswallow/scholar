import MySQLdb
from google_scholar import *

def save2mysql(*s):
    try:
        conn = MySQLdb.connect(host='localhost', user='root',passwd='901212')
    except Exception,e:
        print e
        sys.exit()
    
    '''   
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
       ''' 
    cursor.close();
