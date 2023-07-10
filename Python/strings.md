# String Manipulation

#### Find and replace (Simple)
```
data = data.replace('find_this','replace_with_this').replace('can_be','chained')
print(data)
```

#### Find and replace (Regex)
```
import re
# Segments can be referenced in the replacement with \1, \2
parseData = re.sub('([a-zA-Z0-9])', r'huzzah', parseData)
print(parseData)
```