from selenium import webdriver
from selenium.webdriver.chrome.service import Service # 1) Serviceのインポート
import time
from selenium.webdriver.common.by import By

# chromedriver.exeがある場所
driver_path = "chromedriver.exe"

# webdriverの作成
service = Service(executable_path=driver_path) # 2) executable_pathを指定
driver = webdriver.Chrome(service=service) # 3) serviceを渡す

driver.get('https://www.google.co.jp')
time.sleep(5)

# search_bar = driver.find_element_by_name("q")
driver.find_element(By.NAME,'q').send_keys("google")
time.sleep(1)

driver.find_element(By.NAME,'q').submit()
time.sleep(10)

# webdriverの終了（ブラウザを閉じる）
# driver.quit()
