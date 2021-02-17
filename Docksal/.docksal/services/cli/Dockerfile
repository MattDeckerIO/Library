FROM docksal/cli:2.11-php7.4

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install -yq nodejs build-essential

# Fix npm
RUN npm i -gs npm sass