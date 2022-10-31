# Add users on host machine

    useradd -M --user-group postgres
    useradd -M --user-group caddy

# Other Host Preparation

Increase a kernel value for Caddy:

    sysctl -w net.core.rmem_max=2500000

Copy configuration files to server:

    scp Caddyfile klecks-admanagement.env root@167.235.50.194:~

# Create Docker resources

    docker network create net
    docker volume create postgres-data
    docker volume create caddy-data

# Fix file permissions on Docker volumes

    docker run -it --rm \
        -v postgres-data:/data \
        bash \
        chown "$(id -u postgres):$(id -g postgres)" /data

    docker run -it --rm \
      -v caddy-data:/data \
      bash \
      chown -R "$(id -u caddy):$(id -g caddy)" /data

# Create Docker containers

These next two commands are only necessary if the database cluster has not been initialized yet:

    docker run -it --rm \
        --name postgres-init \
        -v postgres-data:/var/lib/postgresql/data \
        -e POSTGRES_PASSWORD=b45z7DzkHc6RkruF \
        postgres:14

(stop this container once the initialization is done).

    docker run -it --rm \
        --name postgres-init \
        -v postgres-data:/var/lib/postgresql/data \
        bash \
        chown -R "$(id -u postgres):$(id -g postgres)" /var/lib/postgresql/data

Start the database container:

    docker run -d \
        --name postgres \
        --user "$(id -u postgres):$(id -g postgres)" \
        --network net \
        --network-alias postgres \
        --shm-size 256MB \
        --stop-timeout 120 \
        -v postgres-data:/var/lib/postgresql/data \
        -v /etc/passwd:/etc/passwd:ro \
        -p 127.0.0.1:5432:5432 \
        --restart unless-stopped \
        postgres:14

Start the reverse proxy container:

    docker run -d \
      --name caddy \
      --user "$(id -u caddy):$(id -g caddy)" \
      --network net \
      --network-alias caddy \
      -v $PWD/Caddyfile:/etc/caddy/Caddyfile:ro \
      -v caddy-data:/data \
      -v /etc/passwd:/etc/passwd:ro \
      -p 80:80 \
      -p 443:443 \
      --restart unless-stopped \
      caddy:2

# Build the app image

    docker build -t klecks-admanagement .
    docker save klecks-admanagement | gzip | pv | ssh root@167.235.50.194 docker load

# Run the app

    docker run -d \
        --name klecks-admanagement \
        --network net \
        --network-alias klecks-admanagement \
        --env-file klecks-admanagement.env \
        --restart unless-stopped \
        klecks-admanagement