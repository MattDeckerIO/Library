#!/usr/bin/env python3

import os, sys, subprocess, re, json
os.system('clear')

# Primary
def run():
  print("Applying Drupal Security Updates\n")

  # Make sure we are in a Drupal directory
  identifyComposer()
  identifyVendor()

  subprocess.run(['composer','config','process-timeout','2000'])

  outdatedProjects = identifySecurityUpdates()

  # This is typically optional but sometimes required.
  # purge()

  # Applies updates
  total, updated, failed = len(outdatedProjects), 0, 0
  for project in outdatedProjects:
    u, f = applyUpdate(project, outdatedProjects[project])
    updated += u
    failed += f

  print("Updated: "+str(updated))
  print("Failed: "+str(failed))
  print("Total: "+str(total))

def applyUpdate(projectName, projectVersion):
  print('Applying update to '+projectName+"\n")

  projectNameVersion = projectName+':^'+projectVersion
  print("Running: composer require "+projectNameVersion+" --update-with-all-dependencies\n")

  result = subprocess.run(['composer','require',projectNameVersion,'--update-with-all-dependencies'], stdout=subprocess.PIPE, universal_newlines=True)
  updated, failed = 0, 0
  if (result.returncode == 0):
    print(projectName+" updated\n")
    updated = 1
  else:
    print(projectName+' UPDATE FAILED! code: '+str(result.returncode)+"\n")
    failed = 1
  return updated, failed

# Ensures composer.json exists
def identifyComposer():
  if not os.path.isfile(os.path.join(os.getcwd(), 'composer.json')):
    print("Composer.json not found\n")
    sys.exit()
  else:
    print("Composer.json identified\n")

# Ensures autoload.php exists
def identifyVendor():
  if not os.path.isfile(os.path.join(os.getcwd(), 'vendor/autoload.php')):
    print("vendor/autoload.php not found\n")
    sys.exit()
  else:
    print("vendor/autoload.php identified\n")

# Runs composer outdated drupal/* to identify projects requiring updates
def identifySecurityUpdates():
  # Get the list of Drupal updates
  oustandingSecurity = getSecurityUpdates()
  # Get the list of latest versions
  composerOutdated = getNewVersions()

  # Loop through the Drupal updates and get the latest
  # version number from composer.
  projectsToInstall = {}
  for project in oustandingSecurity.keys():
    if project == 'drupal/core':
      project = 'drupal/recommended-project'
    projectsToInstall[project] = composerOutdated[project]

  # Return the number of projects
  if (len(projectsToInstall) == 1):
    print("Identified "+str(len(projectsToInstall))+" outdated project.\n")
  else:
    print("Identified "+str(len(projectsToInstall))+" outdated projects.\n")
  return projectsToInstall

# Gets the latest version numbers of every outdated project
def getNewVersions():
  result = subprocess.run(['composer','outdated','--format=json'], stdout=subprocess.PIPE, universal_newlines=True)
  composerOutdated = result.stdout

  projects = {}
  json_object = json.loads(composerOutdated)

  for project in json_object['installed']:
    n = project['name']
    v = project['latest']
    projects[n] = v

  return projects

# Acquires a list of outstanding Drupal security updates according to Drush
def getSecurityUpdates():
  result = subprocess.run(['drush','sec','--format=json'], stdout=subprocess.PIPE, universal_newlines=True)
  composerOutdated = result.stdout

  projects = {}
  json_object = json.loads(composerOutdated)

  for project in json_object:
    n = json_object[project]['name']
    v = json_object[project]['version']
    projects[n] = v

  return projects

# Deletes things
def purge():
  print('Purging ./composer.lock')
  subprocess.run(['rm','./composer.lock'])
  print('Purging ./vendor')
  subprocess.run(['rm','-r','./vendor'])
  print('Purging ./web/core')
  subprocess.run(['rm','-r','./web/core'])

run()
