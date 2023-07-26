from selenium import webdriver
from selenium.webdriver.edge.service import Service # 1) Serviceのインポート
import time

# msedgedriver.exeがある場所
driver_path = "msedgedriver.exe"

# webdriverの作成
service = Service(executable_path=driver_path) # 2) executable_pathを指定
driver = webdriver.Edge(service=service) # 3) serviceを渡す
driver.get("https://www.yahoo.co.jp/")

# 5秒待つ
time.sleep(5)

# webdriverの終了（ブラウザを閉じる）
driver.quit()
