# Get Node
FROM node:latest as node

# Get Docksal CLI
FROM docksal/cli:php8.1-3

# Copy Node things
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Install SASS
RUN npm install -g sass