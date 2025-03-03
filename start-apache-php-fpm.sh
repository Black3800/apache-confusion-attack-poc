#!/bin/bash

# Start the first process
php-fpm8.2 -D
  
# Start the second process
apachectl -D FOREGROUND
  
# Wait for any process to exit
wait -n
  
# Exit with status of process that exited first
exit $?