# mysql

This directory can contain its own Dockerfile in case we need to modify official mysql image.
`init` directory contains sql dumps that are automatically executed on first `mysql` cotainer startup. It is also the reason why it takes a moment to start the containers for the first time.
`data` directory contains mysql database files. At first the directory is empty. The files are created by `mysql` container and stored here through the docker volume.
