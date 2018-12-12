sudo yum update -y
sudo yum install -y httpd24 php70 mysql56-server php70-mysqlnd
sudo service httpd start
sudo chkconfig httpd on
chkconfig --list httpd
ls -l /var/www
sudo usermod -a -G apache ec2-user
exit
groups
sudo chown -R ec2-user:apache /var/www
sudo chmod 2775 /var/www
find /var/www -type d -exec sudo chmod 2775 {} \;
sudo chmod 2775 /var/www
find /var/www -type d -exec sudo chmod 2775 {} \;
find /var/www -type f -exec sudo chmod 0664 {} \;
echo "<?php phpinfo(); ?>" > /var/www/html/phpinfo.php
sudo service mysqld start
sudo mysql_secure_installation
sudo service mysqld stop
sudo yum install php70-mbstring.x86_64 php70-zip.x86_64 -y
cd /var/www/html
sudo service httpd restart
cd /var/www/html
pwd
wget https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.tar.gz
mkdir phpMyAdmin && tar -xvzf phpMyAdmin-latest-all-languages.tar.gz -C phpMyAdmin --strip-components 1
rm phpMyAdmin-latest-all-languages.tar.gz
sudo service mysqld start
chkconfig --list httpd
exit
sudo yum update
mysql restart
pwd
/etc/init.d/mysqld restart
pwd
cd ..
pwd
cd /etc/init.d
pwd
/etc/init.d/mysqld restart
sudo /etc/init.d/mysqld restart
sudo /etc/init.d/httpd restart
sudo yum update
