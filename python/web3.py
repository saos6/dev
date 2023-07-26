import time
from selenium import webdriver
from selenium.webdriver.common.by import By
# from webdriver_manager.chrome import ChromeDriverManager
#from selenium.webdriver.common.keys import Keys
import pandas as pd
import tqdm
import datetime

#Seleniumを使うための設定とgoogleの画面への遷移
MIN_INTERVAL = 0.5
INTERVAL = 2.5
MINUTE_INTERVAL = 60.0
URL = "https://www.google.com/"
driver_path = "./chromedriver.exe"
# driver = webdriver.Chrome(ChromeDriverManager().install())
driver = webdriver.Chrome()
driver.maximize_window()
time.sleep(INTERVAL)
driver.get(URL)
time.sleep(INTERVAL)

#googleで検索する文字をリスト化
search_string = ['味噌 スープ','しいたけ キャベツ']

#results = None
concat_df = None 
result_df = None 

for query_string in tqdm.tqdm(search_string):
    
    ## フォームに入っている情報を削除
    driver.find_element(By.NAME,'q').clear()

    ## 検索ワードを送信する
    driver.find_element(By.NAME,'q').send_keys(query_string)

    # 検索を実行
    driver.find_element(By.NAME,'q').submit()

    # 待機
    time.sleep(INTERVAL)

    #検索結果の一覧を取得する
    results = []
    flag = False
    while True:

        #g_aryは検索結果のタイトルとURLが入った要素をリストで保持
        g_ary = driver.find_elements(By.CLASS_NAME,'g')
        #print(g_ary)
        
        #title = driver.title
        #url = driver.get(url)
        for g in g_ary:
            result = {}
            #YOUTUBEのときだけ場合わけ、それ以外はスキップ（Wiki等）
            try:
                result['url'] = g.find_element(By.CLASS_NAME,'yuRUbf').find_element(By.TAG_NAME,'a').get_attribute('href')
            except: #YOUTUBE
                try:
                    result['url'] = g.find_element(By.CLASS_NAME,'ct3b9e').find_element(By.TAG_NAME,'a').get_attribute('href')
                except: #Wiki等
                    break
            result['title'] = g.find_element(By.TAG_NAME,'h3').text
            results.append(result)
            if len(results) >= 20:#抽出する件数を指定
                flag = True
                break
        if flag:
            break

        #次のページへ
        driver.find_element(By.ID,'pnnext').click()

        #time.sleep(INTERVAL)


    #pandasでデータフレーム化
    result_df = pd.DataFrame(results)
    result_df.reset_index(inplace=True)
    result_df = result_df.rename(columns={'index': 'rownum'})
    result_df['rownum'] = result_df['rownum'] + 1
    result_df['query'] = query_string

    concat_df = pd.concat([result_df,concat_df], axis=0)
    
    time.sleep(MINUTE_INTERVAL)

concat_df['domain'] = concat_df['url'].str.extract('://([^/]+).*', expand=True)

#今日の日付でCSV保存
now = datetime.datetime.today()
date = str(now.strftime("%y%m%d"))
concat_df.to_csv("keyword_rank_list_"+ date +".csv", encoding="utf-8")
