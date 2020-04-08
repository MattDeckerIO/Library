# Prepend current branch name to commit message
> This script automatically adds the current branch name
> to the beginning of a git commit message.

First, locate the global hook directory.
```bash
git config --global --get core.hookspath
```

Set the global hook directory if one is not set.
```bash
git config --global core.hookspath "~/.githooks"
```

Second, place prepare-commit-msg into that directory.

Third, chmod prepare-commit-msg so it can be executed.
```bash
chmod +x /path/to/hooks/prepare-commit-msg
```

### prepare-commit-msg
```bash
#!/bin/bash

# Put this file in .git/hooks inside each repository

# This way you can customize which branches should be skipped when
# prepending commit message.
if [ -z "$BRANCHES_TO_SKIP" ]; then
  BRANCHES_TO_SKIP=(master develop test)
fi

BRANCH_NAME=$(git symbolic-ref --short HEAD)
BRANCH_NAME="${BRANCH_NAME##*/}"

BRANCH_EXCLUDED=$(printf "%s\n" "${BRANCHES_TO_SKIP[@]}" | grep -c "^$BRANCH_NAME$")
BRANCH_IN_COMMIT=$(grep -c "\[$BRANCH_NAME\]" $1)

if [ -n "$BRANCH_NAME" ] && ! [[ $BRANCH_EXCLUDED -eq 1 ]] && ! [[ $BRANCH_IN_COMMIT -ge 1 ]]; then
  sed -i.bak -e "1s/^/$BRANCH_NAME /" $1
fi
```