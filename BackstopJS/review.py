# Reads the contents backstop.config.js and opens two browser windows
# for manual testing: one showing the 'test' domain and one showing
# the reference (prod) domain.

# @author Matt Decker <me@mattdecker.io>


import re
import webbrowser
import time
import os

file = open('backstop.config.js', 'r')
Lines = file.readlines()

testDomain = 0
for line in Lines:

  # time.sleep(0.5)

  # Get the line
  l = line.strip()

  # Limiter for testing
  # if testDomain > 1:
  #   continue

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
      os.system('open --new -a "Google Chrome" --args --new-window '+url)
    else:
      os.system('open --new -a "Google Chrome" --args '+url)
    testDomain += 1

prodDomain = 0
for line in Lines:

  # time.sleep(0.5)

  # Get the line
  l = line.strip()

  # limiter for testing
  # if prodDomain > 1:
  #   continue

  # Get the prod url
  if (l[0:5]) == '"refe':
    url = re.search("`.+?`", l).group().strip('`')
    print('Production: '+url)
    if (prodDomain == 0):
      os.system('open --new -a "Google Chrome" --args --new-window '+url)
    else:
      os.system('open --new -a "Google Chrome" --args '+url)
    prodDomain += 1