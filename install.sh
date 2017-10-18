#!/bin/bash
#
#

# clear

# Variables
# Name of the project
# 
PROJECTNAME=${PWD##*/}

echo "Ok, lets install that WP."

echo "Starting installation of \""$PROJECTNAME"\""

# Create Database
wp db create

# Install WP. Change URL to match your dev environment
wp core install --url=localhost/$PROJECTNAME --title=$PROJECTNAME --admin_user=admin --admin_password=password --admin_email=admin@meramedia.se --skip-email

read -rsp $'Press any key to continue...\n' -n 1 key