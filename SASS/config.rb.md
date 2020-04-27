# Compass configuration file
> This file tells [Compass](http://compass-style.org/) the source and
> destination directories as well as the output style and format. This file can 
> be placed anywhere but should be in the website root. The directory paths
> (XXX_dir) are relative to this file.

### config.rb
```bash
# Project directories
http_path = "/"
css_dir = "web/path/to/css"
sass_dir = "web/path/to/scss"

# Output styles. (:expanded or :nested or :compact or :compressed)
output_style = :expanded

# Enable relative paths to assets via compass helper functions. (true or false)
relative_assets = true

# Add inline comments. (true or false)
line_comments = false

# Force UTF-8 Encoding.
Encoding.default_external = 'utf-8'

# Create mapper (true or false)
sourcemap = true
```