# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    # box settings
    config.vm.box = "scotch/box"
    config.vm.box_version = ">= 2.5"

    # network
    config.vm.network "private_network", ip: "192.168.33.10"
    # You may safely use this subdomain, as we control the domain and guarantee it won't be used otherwise
    config.vm.hostname = "dev.frogsystem.de"

    # synced directoty
    config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=766"] }

    # hostmanager
    if Vagrant.has_plugin?("vagrant-hostmanager")
        config.hostmanager.enabled = true
        config.hostmanager.manage_host = true
    end

    # provisioning
    config.vm.provision "shell", inline: <<-SHELL
        cd /var/www
        cp -n .env.example .env
        composer install --dev -n --prefer-source
        mysql -uroot -proot scotchbox < migration/structure.sql
    SHELL
end
