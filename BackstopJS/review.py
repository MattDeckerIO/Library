# Reads the contents backstop.config.js and opens two browser windows
# for manual testing: one showing the 'test' domain and one showing
# the reference (prod) domain.

# @author Matt Decker <me@mattdecker.io>

# ================================================

import re
import webbrowser
import time
import os

env = ['test','prod']
# env = ['prod']
# env = ['test']
testing = False

# ================================================

file = open('backstop.config.js', 'r')
Lines = file.readlines()


if 'test' in env:
  print('Capturing test')
  testDomain = 0
  for line in Lines:

    # Get the line
    l = line.strip()

    # Limiter for testing
    if testing:
      if testDomain >= 2:
        continue

    # Get the testing domain name
    if (l[0:5]) == 'var t':
      url_test = re.search("http.+;", l).group().strip(';').strip("'")
      print('Test domain: '+url_test)

    # Get the testing url
    if (l[0:5]) == '"url"':
      url = re.search("`.+?`", l).group().strip('`')
      url = url.replace("${testURL}", url_test)
      print('Test: '+url)
      if (testDomain == 0):
        os.system('open --new -a "Brave Browser" --args --new-window '+url)
      else:
        os.system('open --new -a "Brave Browser" --args '+url)
        time.sleep(0.2)
      testDomain += 1

if 'prod' in env:
  print('Capturing prod')
  prodDomain = 0
  for line in Lines:

    # Get the line
    l = line.strip()

    # limiter for testing
    if testing:
      if prodDomain >= 2:
        continue

    # Get the prod url
    if (l[0:5]) == '"refe':
      url = re.search("`.+?`", l).group().strip('`')
      print('Production: '+url)
      if (prodDomain == 0):
        os.system('open --new -a "Brave Browser" --args --new-window '+url)
      else:
        os.system('open --new -a "Brave Browser" --args '+url)
      time.sleep(0.2)
      prodDomain += 1
