# Jupyter Notebook

1. Place Dockerfile and docker-compose.yml into the folder that will store notebooks.
1. `docker compose build`
1. `docker compose up --detach`
1. `docker ps | grep -i 'jupyter'`
1. Write down the port number pointing to 8888 e.g.
1. Open in a browser http://127.0.0.1:PORTNUMBER

When you are done...
1. `docker compose down`
