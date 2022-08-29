# Launches a defined list of URLs in browser windows and tabs for testing.
# @author Matt Decker <me@mattdecker.io>

# Imports
# ================================================
import time
import os

# Vars
# ================================================
browser = 'Brave Browser'
file = 'review.json'
env = ['local','prod']
testing = True

# Test Cases
# ================================================
tests = {
  "envs": {
    "local": "https://mattdecker.docksal.site",
    "prod": "https://mattdecker.io"
  },
  "tests": {
    "Homepage": "/",
    "Page two": "/inner-page"
  }
}

# Functionality
# ================================================
for e in env:
  base = tests['envs'][e]
  first = True
  print('Opening links for '+e+' at '+base)
  for t in tests['tests']:
    url = base+tests['tests'].get(t)
    print('Opening '+url)
    if first:
      os.system('open --new -a "'+browser+'" --args --new-window '+ url)
    else:
      os.system('open --new -a "'+browser+'" --args '+url)
    first = False
    time.sleep(0.2)
  print('================================================')
print('Done!')