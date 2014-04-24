#!/bin/bash
cd /var/www/7maru/app/
dir="/var/www/backup_store/`date +%Y_%m_%d_%H_%M_%S`"
file="databaseBackup_`date +%Y_%m_%d_%H_%M_%S`.sql"
file_data="backup_`date +%Y_%m_%d_%H_%M_%S`.tar.gz"

mkdir -p ${dir}
chmod -R 755 ${dir}
mysqldump -u root -photada 7maru > ${dir}/${file}
chmod 755 ${dir}/${file}
tar zcf ${dir}/${file_data} data
chmod 755 ${dir}/${file_data}
# tar zcf /home/khaclinh/itjap/backup_store/`date +%Y%m%d%H%M`/backup-`date +%Y%m%d%H%M`.tar.gz 7maru 
