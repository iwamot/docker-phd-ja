NAME := phd-ja
VERSION := $(shell git describe --tags)
HTTP_PORT := 8080
FPM_PORT := 9000

build:
	@docker build -t $(NAME):$(VERSION) .

create:
	@docker create -it -p $(HTTP_PORT):80 -p ${FPM_PORT}:9000 \
                 -v ${CURDIR}/admin:/opt/phd-ja/admin \
                 -v ${CURDIR}/scripts:/opt/phd-ja/scripts \
                 --name $(NAME) $(NAME):$(VERSION)

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
	@docker exec $(NAME) ../scripts/phd-update

build-source:
	@docker build -t phd-ja-source - < Dockerfile.phd-ja-source
