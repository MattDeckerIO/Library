FROM docksal/cli:php8.1-3
# FROM docksal/cli:php7.4-3.1

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && apt-get install -yq nodejs build-essential

# Install composer v2
RUN \
  composer self-update --2

# Fix npm
RUN npm i -gs npm sass

# Disable xdebug when running CLI commands.
RUN touch /home/docker/.bash_aliases
RUN echo -e 'alias drush='XDEBUG_MODE=off drush'' >> /home/docker/.bash_aliases
RUN echo -e 'alias composer='XDEBUG_MODE=off composer'' >> /home/docker/.bash_aliases