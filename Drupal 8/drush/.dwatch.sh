#!/bin/bash

# Continuously pulls the watchdog log allowing
# developers to monitor the log in pseduo realtime
#
# Usage:
# * Put this file in ~/
# * CHMOD the file with +x
#
# Author Matt Decker <mdecker@air.org>
#
function dwatch()
{
  HASH=$(git rev-parse HEAD | head);
  TIME=$(date +"%Y%m%d-%H%M");
  echo $HASH-$TIME > /tmp/$HASH-$TIME.txt;
  while sleep 1; do
    unlink /tmp/$HASH-$TIME.txt
    drush ws --count=30 > /tmp/$HASH-$TIME.txt;
    clear;
    tac /tmp/$HASH-$TIME.txt | head -n -1
  done
}