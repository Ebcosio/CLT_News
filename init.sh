#!/bin/sh
# Make directories for dev env
mkdir data-in wp-app wp-data
# ownership will change to www-data, and it's nice to be able to play around in wp-content as needed.
chmod 777 data-in wp-app wp-data
