# Get Node
FROM node:latest AS node

# Get Docksal CLI
FROM docksal/cli:php8.3-3

# Copy Node things
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Cato Networks VPN
# ADD https://cc2.catonetworks.com/public/certificates/CatoNetworksTrustedRootCA.cer /usr/local/share/ca-certificates/CatoNetworksTrustedRootCA.crt
# RUN update-ca-certificates

# Install SASS
RUN npm install -g sass

# Install Web Component Tooling
# RUN npm install -g webpack webpack-cli to-string-loader css-loader sass-loader babel-loader