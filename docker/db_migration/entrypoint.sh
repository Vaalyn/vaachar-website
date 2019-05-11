#!/bin/bash

dockerize -wait tcp://mariadb:3306 -timeout 60s

/vaachar/vendor/bin/phinx migrate -c /vaachar/config/phinx.php
/vaachar/vendor/bin/phinx seed:run -c /vaachar/config/phinx.php
