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