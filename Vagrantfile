# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
    config.hostmanager.ignore_private_ip = false
    config.hostmanager.include_offline = true

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.33.10"
    # You may safely use this subdomain, as we control the domain and guarantee it won't be used otherwise
    config.vm.hostname = "dev.frogsystem.de"
    config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=766"] }

    config.vm.provision "shell", inline: <<-SHELL
        # Update packages
        sudo apt-get update
        sudo apt-get upgrade -y

        # install xdebug
        sudo apt-get install php5-xdebug
        sudo service apache2 restart

        # composer to path
        export PATH="~/.composer/vendor/bin:$PATH"
    SHELL
end
