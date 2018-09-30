# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  #config.vm.box = "bento/ubuntu-18.04"
  config.vm.box = "omarsadek/osprojectskeleton"
  config.vm.box_version = "1.0.0"

  config.vm.network :forwarded_port, guest: 8100, host: 8100

  config.vm.synced_folder ".", "/home/vagrant"

  config.vm.provider "virtualbox" do |vb|
    vb.gui = false

    vb.name = "osprojectskeleton"
    vb.memory = "2048"
    vb.cpus = 2
  end

  #config.vm.provision :shell, path: "vagrant/script/packages.sh"
  config.vm.provision :shell, path: "vagrant/script/provision.sh"
end
