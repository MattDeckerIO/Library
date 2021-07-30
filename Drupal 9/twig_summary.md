# Summary field
> This this twig template creates a 50 word summary with ellipses. The summary value
> is used and falls back to the body field. This is commonly used as a custom Twig
> field in Display Suite.

### Instructions
1. Create a new Display Suite field as type Twig field.
1. Attach it to the entity type that needs the field. e.g. Node.
1. Limit the field to the appropriate display type. e.g. *|teaser.
1. Add the value below as the Template.
1. Go to the display mode for the teaser display of your content type.
1. Add the new Display Suite field to the display.

```twig
{# Author: Matt Decker <mdecker@air.org> #}

{# Get the body field and remove HTML #}
{% set output = entity.body.0.value|striptags %}

{# Does a summary exist? #}
{% if entity.body.0.summary %}
  {# A summary exists: use it, and remove HTML #}
  {% set output = entity.body.0.summary|striptags %}
{% endif %}

{% autoescape false %}
  {# Is the length over 300 characters? #}
  {% if output|length > 300 %}
    {# Split the summary into an array, tuncate to 50 words, rejoin, and add ellipses #}
    {{ output|split(' ')|slice(0, 50)|join(' ') }} ...
  {% else %}
    {# Output was shorter than 300 characters: use it. #}
    {{ output }}
  {% endif %}
{% endautoescape %}