# Launches a defined list of URLs in browser windows and tabs for testing.
# @author Matt Decker <me@mattdecker.io>

# Usage: review.py env env env
# e.g.   review.py local prod

# Imports
# ================================================
import time
import os
import sys

# Vars
# ================================================
browser = 'Brave Browser'

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

# Collect passed arguments
args = sys.argv
args.pop(0)
if (len(args) == 0):
  print('No environments provided')
  exit()

print('Testing '+', '.join(args))

for e in args:
  # Test if passed arguments are valid.
  if e not in tests['envs']:
    print(e+' is not a valid environment name.')
    print('Available names: '+', '.join(tests['envs'].keys()))
    continue
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