import pymysql
from collections import Counter
from sqlalchemy import create_engine
from flask import Flask, render_template,request
import json
import sys
import numpy as np
import pandas as pd
import sklearn
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from datetime import date
global today
today = date.today()
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


#mysql+pymysql://user_id:password@host/db_name
db_connection = pymysql.connect(host="localhost",user="root",password="Naruto12@",database="taj", charset='utf8',use_unicode=True,port=3306)


#id=request.get_json(force=True)
day = today.strftime("%Y-%m-%d")
df_programs = pd.read_sql("select * from program WHERE end_date>'%s'" % day, db_connection)
## Removing first comma from the string in type
df_programs.type = df_programs.type.apply(lambda x: x[0:-2] if x[-1] == "," else x)
df_programs.head()
df_programs.type = df_programs.type.str.split(',')
df_programs
#Explode dataframe on type to create multiple rows on each type 
df_programs = df_programs.explode('type').reset_index(drop=True)
df_programs.head(5)
df_programs.name.value_counts()
df_programs.type.value_counts()
@app.route('/api/result1',methods=['POST'])
def data():
    id=request.get_json(force=True)
    df_member = pd.read_sql("SELECT * FROM enroll WHERE volenteer_id=%i AND status='انتهى'" % id, db_connection)
    df_member.head(5)
    jsonList = json.dumps("result", cls=NpEncoder)
    ## Aggregate programs from volunteers
    global df_member_agg
    df_member_agg = df_member.groupby(['volenteer_id'])['program_id'].unique().reset_index(name = 'programs_list')
    return generate_recommendations()

def get_programs_order(list_programs):
    list_all_programs_enrolled = [item for sublist in df_member_agg.programs_list.values for item in sublist]
    
    dict_program_counter = Counter(list_all_programs_enrolled)
    
    #Not all the programs in the programs database are selected by users
    #So the programs in programs list which are not selected by any user
    #Mark their selected count as 0
    
    list_unique_programs = df_programs.id.unique()
    
    for each in list_unique_programs:
        if each not in list_all_programs_enrolled:
            dict_program_counter[each] = 0
            
    return sorted(list_programs, key=dict_program_counter.get, reverse=True)

result=[]

def generate_recommendations():
    id=request.get_json(force=True)
    volenteer_id=id
    print(id)
    num_recommendations=3
    #Select programs list
    list_programs = df_member_agg[df_member_agg.volenteer_id == volenteer_id].programs_list.values[0]
    # Get unique types of those watched programs
    list_uique_types = df_programs[df_programs.id.isin(list_programs)].type.unique()

    print ("Recommendation for the user are: ")
    #Get other programs with same type
    list_id_other_programs = df_programs[~df_programs.id.isin(list_programs)][df_programs.type.isin(list_uique_types)].id.values
    print (list_id_other_programs)
    
    if len(list_id_other_programs) > 0:
        #sort the recommendations based on total selections of each program by unique volentters
        list_sorted_programs = get_programs_order(list_id_other_programs)
        list_recommendations = df_programs[df_programs.id.isin(list_sorted_programs)].id.values
        
        
        for each in range(min(len(list_recommendations), num_recommendations)):
            global result
            global jsonList
            result.append(list_recommendations[each])
            jsonList = json.dumps(result, cls=NpEncoder)
            print (list_recommendations[each])
        result = []
    
    else:
        print ("Not enough data to generate recommendation for the user")
        return false
    return jsonList



if __name__ == '__main__':
   app.run(host='0.0.0.0',port=5000,debug=True)
