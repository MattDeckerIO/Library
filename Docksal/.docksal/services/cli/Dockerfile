FROM docksal/cli:php8.1-3

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install -yq nodejs build-essential

# Install composer v2
RUN \
  composer self-update --2

# Fix npm
RUN npm i -gs npm sass