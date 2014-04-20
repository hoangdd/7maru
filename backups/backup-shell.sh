#!/bin/bash
#cd /var/www/
dir="/var/www/backup_store/`date +%Y_%m_%d_%H_%M_%S`"
file="databaseBackup_`date +%Y_%m_%d_%H_%M_%S`.sql"
mkdir -p ${dir}
chmod -R 755 ${dir}
mysqldump -u root -p123456 7maru > ${dir}/${file}
chmod 755 ${dir}/${file}
# tar zcf /home/khaclinh/itjap/backup_store/`date +%Y%m%d%H%M`/backup-`date +%Y%m%d%H%M`.tar.gz 7maru 
