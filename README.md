# docker-phd-ja

[![CircleCI](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master.svg?style=svg)](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master)

## How to use this image

```
# Pull this image
docker pull iwamot/phd-ja

# Create the container
docker create -it -p 8080:80 --name phd-ja iwamot/phd-ja

# Start the container
docker start phd-ja

# Refer documentation
curl http://localhost:8080/phd-ja/

# Update source
docker exec phd-ja svn up

# Use bash in the container
docker exec -it phd-ja bash

# Edit source files by vim and exit

# Re-create doc-base/.manual.xml
docker exec phd-ja ../scripts/phd-configure

# Generate documentation
docker exec phd-ja ../scripts/phd-build

# Refer generated documentation
curl http://localhost:8080/phd-ja/
```

## How to development

```
# Clone this repository
git clone git@github.com:iwamot/docker-phd-ja.git
cd docker-phd-ja

# Build the image
make build

# Create the container
make PORT=8081 create

# Start the container
make start

# Refer documentation
curl http://localhost:8081/phd-ja/

# Update source
make phd-update

# Use bash in the container
make bash

# Edit source files by vim and exit

# Re-create doc-base/.manual.xml
make phd-configure

# Generate documentation
make phd-build

# Refer generated documentation
curl http://localhost:8081/phd-ja/

# Stop the container
make stop

# Remove the container
make rm
```
