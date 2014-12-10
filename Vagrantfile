# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "scotch/box"
  config.vm.network "private_network", ip: "192.168.33.10"
  config.vm.network "forwarded_port", guest: 3306, host: 3306
  config.vm.hostname = "scotchbox"
  config.vm.synced_folder "./src", "/var/www", :mount_options => ["dmode=777", "fmode=666"]

end