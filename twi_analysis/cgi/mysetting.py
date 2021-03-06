#!/usr/bin/env python
# -*- coding: utf-8 -*-

from pymongo import MongoClient

# 使わないのでとりあえずコメントアウト
# KEYS = {  # 自分のアカウントで入手したキーを下記に記載
#     'consumer_key': '**********',
#     'consumer_secret': '**********',
#     'access_token': '**********',
#     'access_secret': '**********',
# }

# PHP に返す用途で表示する文字列の定数
RETURN_STRING_SUCCESS = "Success"
RETURN_STRING_ERROR = "Error"
RETURN_STRING_FINISH = "Finish"
RETURN_STRING_EXCEPTION = "Exception"
RETURN_STRING_RUNTIME_ERROR = "RuntimeError"

HOST_NAME = "localhost"
PORT = 27017

# twitter = None
connect = None
db = None
tweetdata = None
nega_pogi = None


def initialize():  # twitter接続情報や、mongoDBへの接続処理等initial処理実行
    global twitter, connect, db, tweetdata, nega_pogi

    # 使わないのでとりあえずコメントアウト
    # twitter = OAuth1Session(KEYS['consumer_key'], KEYS['consumer_secret'],
    #                         KEYS['access_token'], KEYS['access_secret'])
    connect = MongoClient(HOST_NAME, PORT)
    db = connect.twi_analysis
    tweetdata = db.tweetdata
    nega_pogi = db.nega_pogi


initialize()
