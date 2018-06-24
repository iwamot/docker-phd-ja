# docker-phd-ja

[![CircleCI](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master.svg?style=svg)](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master)

## How to development

```
# Clone this repository
git clone git@github.com:iwamot/docker-phd-ja.git
cd docker-phd-ja

# Build an image
make build

# Create the container
make PORT=8081 create

# Start the container
make start

# Use the web interface
http://localhost:8081/phd-ja-admin/

# Edit PHP scripts
vim admin/*

# Edit bash scripts
vim scripts/*

# Use bash in the container, if necessary
make bash

# Stop the container
make stop

# Remove the container
make rm
```

## Built with

- [ElaAdmin](https://github.com/puikinsh/ElaAdmin)
- [Font Awesome Free](https://github.com/FortAwesome/Font-Awesome)
- [Ace](https://github.com/ajaxorg/ace-builds)
