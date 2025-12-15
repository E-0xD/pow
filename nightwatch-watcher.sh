#!/bin/bash

OUTPUT=$(php artisan nightwatch:status 2>&1)
echo "Output: '$OUTPUT'"