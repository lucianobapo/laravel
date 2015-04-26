#!/bin/sh
chgrp www-data -R storage/
chmod g+s storage/logs/
chmod g+s storage/debugbar/
