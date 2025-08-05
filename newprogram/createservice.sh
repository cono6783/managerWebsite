#!/bin/bash
# createservice.sh [name] [exec path] [working dir] [user]

echo "[Unit]" >> /etc/systemd/system/$1.service
echo "Description=$1" >> /etc/systemd/system/$1.service
echo "after=network.target" >> /etc/systemd/system/$1.service
echo "" >> /etc/systemd/system/$1.service
echo "[Service]" >> /etc/systemd/system/$1.service
echo "WorkingDirectory=$3" >> /etc/systemd/system/$1.service
echo "ExecStart=$2" >> /etc/systemd/system/$1.service
echo "User=$4" >> /etc/systemd/system/$1.service
echo "" >> /etc/systemd/system/$1.service
echo "[Service]" >> /etc/systemd/system/$1.service
echo "WantedBy=multi.user.target" >> /etc/systemd/system/$1.service

systemctl start $1 #This will get moved to the project management page in the future
systemctl enable $1 #Enabling the service to run on startup might be moved to an option

