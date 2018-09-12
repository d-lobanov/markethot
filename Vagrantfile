Vagrant.configure("2") do |config|
  config.vm.box = "phusion/ubuntu-14.04-amd64"

  config.vm.network "private_network", type: "dhcp"
  config.vm.synced_folder ".", "/vagrant", type: "nfs"

  config.vm.network "forwarded_port", guest: 80, host: 8081
  config.vm.network "forwarded_port", guest: 3306, host: 3308
  config.vm.network "forwarded_port", guest: 9200, host: 9201

  config.vm.provision :docker
  config.vm.provision :docker_compose, rebuild: true, run: "always", yml: "/vagrant/docker-compose.yml"

end
