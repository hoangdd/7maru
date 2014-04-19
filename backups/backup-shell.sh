#!/bin/bash

 cd /var/www/
 mkdir /home/khaclinh/itjap/backup_store/`date +%Y%m%d%H%M`
 chmod -R 755 /home/khaclinh/itjap/backup_store/`date +%Y%m%d%H%M`
 mysqldump -u root -p123456 7maru >    /home/khaclinh/itjap/backup_store/`date +%Y%m%d%H%M`/databaseBackup_`date +%Y%m%d%H%M`.sql
 tar zcf /home/khaclinh/itjap/backup_store/`date +%Y%m%d%H%M`/backup-`date +%Y%m%d%H%M`.tar.gz 7maru
 chmod -R 755 
