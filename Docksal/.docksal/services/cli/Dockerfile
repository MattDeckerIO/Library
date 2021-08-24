FROM docksal/cli:php7.4-3

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install -yq nodejs build-essential

# Fix npm
RUN npm i -gs npm sass