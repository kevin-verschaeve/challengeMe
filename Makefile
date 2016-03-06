FIG=docker-compose
RUN=$(FIG) run --rm tools

all: configure start

configure:
	cp app/config/parameters.yml.dist app/config/parameters.yml
	cp docker-compose.yml.dist docker-compose.yml

start:
	$(FIG) build --no-cache
	$(FIG) up -d

reboot:
	$(FIG) kill
	$(FIG) rm -fv
	$(FIG) build
	$(FIG) up -d

host-manager:
	docker run -d --name docker-hostmanager -v /var/run/docker.sock:/var/run/docker.sock -v /etc/hosts:/hosts iamluc/docker-hostmanager

