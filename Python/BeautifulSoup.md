# Beautiful Soup

#### Import BeautifulSoup
```
from bs4 import BeautifulSoup
```

#### Reading XML Tags
```
rows = 0

soup = BeautifulSoup(data, 'xml')
for row in soup.find_all('row'):
  rows += 1

  if row.TagName
    tagValue = row.TagName.string
    # Sometimes... tagValue = str(row.TagName.string)
    # Sometimes... tagValue = row.TagName.get_text()

    # Do something with the tagValue

data = str(soup) # Write modifications to the original data.
```

#### Creating a new XML Tag from an old tag
> To preserve HTML wrapped in <![CDATA[ set the BeautiulSoup second argument to html.parser and get the value of the tag with .string
```
rows = 0

soup = BeautifulSoup(data, 'xml')
for row in soup.find_all('row'):
  rows += 1

  if row.TagName
    tagValue = row.TagName.string

    new_tag = soup.new_tag('TagNameNew')
    new_tag.string = tagValue + 'modifications'
    row.append(new_tag)

    # Do something with the tagValue

data = str(soup) # Write modifications to the original data.
```

#### Identify distinct and duplicate values
```
### Identify duplicate IDs
id_dupes = []
id_uniqs = []

soup = BeautifulSoup(data, 'xml')
for row in soup.find_all('row'):

    if row.id:
        id = row.id.string
        if id in id_uniqs:
            id_dupes.append(id)
        else:
            id_uniqs.append(id)
```