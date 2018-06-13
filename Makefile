NAME := phd-ja
VERSION := $(shell git describe --tags)
PORT := 8080

build:
	@docker build -t $(NAME):$(VERSION) .

create:
	@docker create -it -p $(PORT):80 --name $(NAME) $(NAME):$(VERSION)

start:
	@docker start $(NAME)

stop:
	@docker stop $(NAME)

rm:
	@docker rm $(NAME)

logs:
	@docker logs $(NAME)

attach:
	@docker attach $(NAME)

bash:
	@docker exec -it $(NAME) bash

phd-configure:
	@docker exec $(NAME) ../scripts/phd-configure

phd-build:
	@docker exec $(NAME) ../scripts/phd-build

phd-update:
	@docker exec $(NAME) svn up

build-source:
	@docker build -t phd-ja-source - < Dockerfile.phd-ja-source
