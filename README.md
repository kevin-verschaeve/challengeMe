challengeMe
===========

##  Pour démarrer l'application:
`make`

Cette commande va lancer les conteneurs docker nécessaire à l'application (et les télécharger si ils ne sont pas déjà
présents sur la machine).

Cette opération peut prendre un certain la première fois, puis lancera le projet en quelques secondes les fois suivantes.

### Pour rédemarrer tous les conteneurs
`make reboot`

### Accéder à l'application
> 2 manières:
   > - en allant directement sur l'ip du conteneur (faire un `docker inspect --format '{{ .NetworkSettings.IPAddress }}' challenge-me` pour avoir l'ip)
   > - en utilisant docker-hostmanager. `make host-manager`, puis aller sur [http://challenge-me.docker] (http://challenge-me.docker)

La deuxième solution est recommandée, du fait que l'adresse IP du conteneur peut changer souvent


##### Fixtures
Placer les fixtures dans le dossier AppBundle\\DataFixtures\\ODM\\*className*.yml

Lancer `make fixtures` pour les charger
