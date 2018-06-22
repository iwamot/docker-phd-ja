# docker-phd-ja

[![CircleCI](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master.svg?style=svg)](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master)

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
