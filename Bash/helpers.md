# Helpful aliases and functions
> Load these to your ~/.bashrc.

### Directory Navigation
```bash
alias la="ls -alh"
alias home="cd ~/Sites"

function cd {
  builtin cd "$@" && la
}
```

### Recursively search the current directory by filename and contents.

> This function allows you to search for files that match a given pattern
> and only return those which contain a given string.

Examples:

`search '*settings.php' file_private_path`

`search '*.php' 'mhash('`

```bash
# Search
function search
{
  find ./ -type f -name "${1}" -exec grep -H "${2}" {} \;
}
```

### List all file extensions found in the current directory and below.
```bash
find ./ -type f | sed -n 's/.*\.\([a-zA-Z0-9]*\)$/\1/p' | sort | uniq
```

### Set the permission to files with following case-insensitive extensions to 644.
```bash
find ./ -type f \( -name "*.ext1" -o -name "*.ext2" -o -name "*.ext3" \) -exec chmod 644 {} \;
```

### Recursively compare directories and copy unique values from second folder to ./migrate
```bash
#!/bin/bash

# Check if two parameters are provided
if [ "$#" -ne 2 ]; then
    echo "Usage: bash migrate.sh <folder1> <folder2>"
    exit 1
fi

folder1=$1
folder2=$2

# Compare the two directories recursively and output the differences to migrate.diff
diff -qr "$folder1"  "$folder2" | grep "Only in $folder2" > migrate.diff

echo "Differences have been written to migrate.diff"

# Copy files to migrate directory

# Check if migrate.diff exists
if [ ! -f migrate.diff ]; then
    echo "migrate.diff not found!"
    exit 1
fi

# Create the migrate directory if it doesn't exist
mkdir -p migrate

# Read migrate.diff line by line
while IFS= read -r line; do
    # Extract the file path from the line
    file_path=$(echo "$line" | sed 's/Only in //; s/: /\/\//')

    # Extract the directory and file name
    dir=$(dirname "$file_path")
    file=$(basename "$file_path")

    # Create the directory structure in the migrate folder
    mkdir -p "migrate/$dir"

    # Copy the file to the migrate folder
    cp "$file_path" "migrate/$dir/$file"
done < migrate.diff

echo "Files have been copied to the migrate folder."
```
