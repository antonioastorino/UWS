# UBS
## Ubuntu web server

I'm learning how to create a website combining PHP, JavaScript, and C++. I am using VirtualBox on Mac to setup a webserver on Ubuntu 18.04.

## LAMB server installation

### Created a new VM from Ubuntu mini.iso

Important options:

- Enable 2 processors at least
- Disable the audio support
- An HTTP rule with host port 8080 and guest port 80
- An SSH rule with host port 2221 and guest port 22
- A shared folder pointing to the website folder under development on the local machine - namely this directory
	- Unselect Read-only
	- Unselect Auto-mount

During the installation,

- enable automatic security updates
- install
	- LAMP server
	- OpenSSH server
	- Basic Ubuntu server

When done:

```
$ sudo apt update
$ sudo apt upgrade
$ sudo apt install build-essential linux-headers-virtual dkms vim zip unzip wget curl man-db acpid -y
$ sudo apt install virtualbox-guest-utils
$ sudo apt install virtualbox-guest-dkms
$ sudo apt install virtualbox-guest-x11 
$ sudo reboot
```

### Mount the shared folder

Let <shared_folder_name> name of the shared folder where this project is located - not the full path, just the name used when setting up VirtualBox shared folder. The following commands will mount the shared folder in `~/shared` 

```
$ mkdir ~/shared
$ sudo echo "<shared_folder_name> /home/antonio/shared vboxsf rw,exec 0 0" >> /etc/fstab
$ sudo echo "vboxsf" >> /etc/modules
$ sudo mount shared 
```

Verify that the folder is mounted correctly with `ll ~/shared`. You may want to give read-only access to the mounted folder by replacing `rw,exec` with `default` in `fstab`. Here, due to the compilation via `make` in the `php` script, write access is needed.

### Configure apache

Create a config file `/etc/apache2/sites-available/$(hostname).conf` with the following content:

```
<VirtualHost *:80 *:8082>
	ServerName $(hostname)
	DocumentRoot /var/www/html
	LogLevel info
	ErrorLog ${APACHE_LOG_DIR}/$(hostname)-error.log
	CustomLog ${APACHE_LOG_DIR}/$(hostname)-access.log combined
	<Location /server-status>
	SetHandler server-status
	Order allow,deny
	Allow from all
	Require all granted
	</Location>
</VirtualHost>
```

Modify `/etc/apache2/ports.conf` to add `Listen 8080` in an empty line;

Disable the default site and enable the new one

```
sudo a2disssite 000-default.conf
sudo a2ensite $(hostname).conf
sudo a2enmod rewrite
sudo a2enmod vhost_alias
sudo a2enmod status
systemctl restart apache2
```

Check if it works by going to `ubuntu-web-server:8082/server-status` and  `ubuntu-web-server:8082`.



## References
shell_exec: https://www.youtube.com/watch?v=DPvugEbcujo
php in general: https://www.w3schools.com/php/
[Lamb server installation](https://www.youtube.com/watch?v=dJwSgypywB4)
[Mounting VirtualBox shared folders on Ubuntu Server](https://gist.github.com/estorgio/1d679f962e8209f8a9232f7593683265)

