# REST version of EEMS (Employee Engagement Management System) application

This is a backend version of the EEMS (Employee Engagement Management System) application that only provides a REST API. 

This is using a **Laravel Framework** working for **Homestead**.

## Entity Relationship Diagram
![alt ERD](ERD.png)

## API Documentation
[See api documentation](https://documenter.getpostman.com/view/2303765/SVSKKTVa)

## Running the application locally

### Requirements
- composer
- vagrant
- virtualbox
- ssh key

#### Setup for eems-api project
`git clone https://github.com/louislingatong/eems-rest.git`
`cd eems-rest`
`composer install`

### Setup for Homestead [(reference)](https://laravel.com/docs/5.8/homestead)

#### Install the vagrant box.
`vagrant box add laravel/homestead`

#### Install the homestead repository
`cd ~`
`git clone https://github.com/laravel/homestead.git Homestead`
`bash init.sh`

`vi Homestead.yaml`

Then, edit it like this.

```:bash
ip: "192.168.10.10"
memory: 2048
cpus: 2
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: C:/Development/eems-rest
      to: /home/vagrant/eems-rest

sites:
    - map: eems.local
      to: /home/vagrant/eems-rest/public

databases:
    - eems

# ports:
#     - send: 50000
#       to: 5000
#     - send: 7777
#       to: 777
#       protocol: udp
```

And, edit a hosts file.

`vi /etc/hosts`

```
##
# Host Database
#
# localhost is used to configure the loopback interface
# when the system is booting.  Do not change this entry.
##
192.168.10.10 eems-rest.local
```

#### Start up the vagrant
`cd ~/Homestead`
`vagrant up`

Then you will be able to access the site via your web browser.
`http://eems-rest.local`
