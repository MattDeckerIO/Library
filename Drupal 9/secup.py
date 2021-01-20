#!/usr/bin/env python3

import os, sys, subprocess, re, json
os.system('clear')

# Primary
def run():
  print("Applying Drupal Security Updates\n")

  # Make sure we are in a Drupal directory
  identifyComposer()
  identifyVendor()

  # subprocess.run(['composer','config','process-timeout','2000'])

  outdatedProjects = identifySecurityUpdates()

  # This is typically optional but sometimes required.
  purge()

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
  # subprocess.run(['composer','config','process-timeout','2000'])
  if projectName == 'drupal/core':
    projectName = 'drupal/core-recommended'

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
  result = subprocess.run(['drush','sec','--format=string'], stdout=subprocess.PIPE, universal_newlines=True)
  composerOutdated = result.stdout

  newVersions = getNewVersions()

  projects = {}
  outdatedProjects = re.findall(r"(drupal/.+)", composerOutdated)
  for project in outdatedProjects:
    if '\t' in project:
      project_version = project.split('\t')
      name = project_version[0]
      projects[name] = newVersions[name]

  # Return the number of projects
  if (len(projects) == 1):
    print("Identified "+str(len(projects))+" outdated project.\n")
  else:
    print("Identified "+str(len(projects))+" outdated projects.\n")
  return projects

def getNewVersions():
  result = subprocess.run(['composer','outdated','--format=json'], stdout=subprocess.PIPE, universal_newlines=True)
  composerOutdated = result.stdout

  projects = {}
  json_object = json.loads(composerOutdated)

  for project in json_object['installed']:
    n = project['name']
    v = project['latest']
    if project == 'drupal/core':
      projects['drupal/core-recommended'] = v
    projects[n] = v

  return projects

def purge():
  print('Purging ./composer.lock')
  subprocess.run(['rm','./composer.lock'])
  print('Purging ./vendor')
  subprocess.run(['rm','-r','./vendor'])
  print('Purging ./web/core')
  subprocess.run(['rm','-r','./web/core'])

run()
