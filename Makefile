FIG=docker-compose
RUN=$(FIG) run --rm tools

all: configure build start

configure:
	cp app/config/parameters.yml.dist app/config/parameters.yml
	cp docker-compose.yml.dist docker-compose.yml

build:
	$(FIG) build --no-cache

start:
	$(FIG) up -d

fixtures:
	$(RUN) php app/console hautelook_alice:doctrine:mongodb:fixtures:load --no-interaction

reboot:
	$(FIG) kill
	$(FIG) rm -fv
	$(FIG) build
	$(FIG) up -d

host-manager:
	docker run -d --name docker-hostmanager -v /var/run/docker.sock:/var/run/docker.sock -v /etc/hosts:/hosts iamluc/docker-hostmanager

