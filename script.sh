#!/bin/bash
#Attention ce code fonction de facon brutale, il ne peut etre arrete que par la fermutre du terminal 
cd /var/www/html
python Recup_20.py
while [ 1 ]
do
python SocialDevice.py
done
