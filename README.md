# CLT News Site

## Development environment

The development environment configuration included assumes a
UNIX-like OS, mostly because of the Docker dependency.

Tools you need to have installed: `docker`, `docker-compose`.

When you first checkout this repo
- run `./init.sh` to create the data and Web server directories.
- To start the WP services, run `docker-compose up -d`.
- run `sudo chown -R 33:33 wp-app` to let WordPress update files on
its own (e.g. plugin/core updates)
    - 33 is the default UID for Apache2's user in Debian, which is
    what the WordPress container uses.


The Compose file tells the WordPress web server to listen on port
80. If you have another Web server running on your machine, this
will cause a conflict. Either modify the `docker-compose.yml` file
to make WP listen on another port, or stop your other Web server.

Check the documentation for Docker, Docker Compose, or the
Docker images (e.g. mariadb, WordPress) for further documentation.

### Stubbing CES

A Node.js application stubs CES for our development environment.
The docker-compose file includes support for the CES stub server for
convenience. Since it's all contained in Docker, you don't have to know
about Node.js development to use it.

If you find the need, you can also run the stub server directly on your 
host OS with `npm run start`. (npm is a program installed with Node.js).

If you don't use the Docker setup, you can either modify the source code
for the `CES_API` class to use your new host and port to access the stub
server, or you can set up your local machine to resolve `ces-stub` via
DNS and run the stub server on port `8080`.

This stub server does not respect the query strings for `start_date` and
`end_date` as the live API does.

CES will receive updates, making the stub server's JSON schema out-of-date.
To update the stub server, just copy a response from the CES events endpoint
into `ces-stub-server/events.json`.


