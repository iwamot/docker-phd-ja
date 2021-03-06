# docker-phd-ja

A web interface for building Japanese PHP documentation.

Its main purpose is to make the translation work easier.

[![CircleCI](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master.svg?style=svg)](https://circleci.com/gh/iwamot/docker-phd-ja/tree/master)

## Features

- Documentation
  - Edit source files
  - Build
  - View generated documentation
- Subversion working copy
  - Display status (svn status)
  - Display local modifications (svn diff)
  - Revert all local edits (svn revert)
  - Update (svn update)

## Screenshots

### Edit

![Edit](https://raw.githubusercontent.com/iwamot/docker-phd-ja/master/screenshots/edit.png)

### Build

![Build](https://raw.githubusercontent.com/iwamot/docker-phd-ja/master/screenshots/build.png)

### Diff

![Diff](https://raw.githubusercontent.com/iwamot/docker-phd-ja/master/screenshots/diff.png)

## Download

You can download the Docker image from [the Docker Hub repository](https://hub.docker.com/r/iwamot/phd-ja/).

```
docker pull iwamot/phd-ja
```

## Development status

This software is a **beta** version. Please use it at your own risk.

## How to contribute

Any contribution is welcome. Please open an issue or create a pull request.

## How to develop

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

# Edit shell scripts
vim scripts/*

# Use shell in the container, if necessary
make sh

# Stop the container
make stop

# Remove the container
make rm
```

## Built with

- [ElaAdmin](https://github.com/puikinsh/ElaAdmin)
- [Font Awesome Free](https://github.com/FortAwesome/Font-Awesome)
- [Ace](https://github.com/ajaxorg/ace-builds)
- [suggest.js](https://github.com/onozaty/suggest.js)
