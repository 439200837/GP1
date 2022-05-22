import sys
import numpy as np
import pandas as pd
import pymysql
from collections import Counter
import sklearn
from sklearn.feature_extraction.text import TfidfVectorizer
from sqlalchemy import create_engine
from sklearn.metrics.pairwise import cosine_similarity
from flask import Flask, render_template,request
import json

app = Flask(__name__)

class NpEncoder(json.JSONEncoder):
    def default(self, obj):
        if isinstance(obj, np.integer):
            return int(obj)
        if isinstance(obj, np.floating):
            return float(obj)
        if isinstance(obj, np.ndarray):
            return obj.tolist()
        return super(NpEncoder, self).default(obj)

db_connection = pymysql.connect(host="localhost",user="root",password="Naruto12@",database="taj", charset='utf8',use_unicode=True,port=3306)
pd.read_sql("show tables",db_connection)

df_programs = pd.read_sql("SELECT * FROM program", db_connection)
df_programs.head(2)
df_programs.head()

df_programs.preference = df_programs.preference.str.split(',')
#Explode dataframe on type to create multiple rows on each type 
df_programs = df_programs.explode('preference').reset_index(drop=True)
df_programs.head()

df_programs.name.value_counts()
df_programs.preference.value_counts()
# print(df_programs)

# id=request.get_json(force=True)
# df_volunteer = pd.read_sql("select * from Preference INNER JOIN volunteer WHERE volunteer.email_address=Preference.Vemail_address AND volunteer.numvolunteer=0 AND volunteer.id=%i" % id, db_connection)
# # print(df_volunteer)
# df_volunteer.head()

result=[]
## find best programs 
##this method compare user preferences with program's preferences and reurn a list with id's the most matched programs
@app.route('/api/result', methods=['POST'])
def findPrograms():
 id=request.get_json(force=True)

 df_volunteer = pd.read_sql("select * from preference INNER JOIN volunteer WHERE volunteer.email_address=preference.Vemail_address AND volunteer.numvolunteer=0 AND volunteer.id=%i" % id, db_connection)
 df_volunteer.head()
 x = len(df_programs)
 y = len(df_volunteer)
 i=0
 count=0
 while i<x:
    j=0
    while j<y:
       if(df_volunteer['Preferences'][j]==df_programs['preference'][i]):
         count+=1
       j+=1
    i+=1
    if(count>0):
       global result
       result.append(df_programs['id'][i])
    count=0
    jsonList = json.dumps(result, cls=NpEncoder)
 result = []
 return jsonList

if __name__ == '__main__':
   app.run(host='0.0.0.0', port=5001,debug=True)
   

