# docker-phd-ja

## Example Usage

```
# Build the image
make build

# Create the container
make create

# Start the container
make start

# Refer documentation
curl http://localhost:8080/phd-ja/

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
curl http://localhost:8080/phd-ja/

# Stop the container
make stop

# Remove the container
make rm
```
