# Completely reset the history of a given branch

```bash
#!/bin/bash


# Safety prompt
read -p "This will ERASE ALL HISTORY on 'origin/main'. Are you sure? (y/N) " confirm
if [[ $confirm != [yY] ]]; then
    echo "Aborted."
    exit 1
fi

# Step 1: Create a new orphan branch
git checkout --orphan temp-reset-branch

# Step 2: Remove all files from the index
git rm -rf . > /dev/null 2>&1

# Step 3: Add fresh content (optional - change this if needed)
echo "# Fresh start" > README.md
git add README.md
git commit -m "Initial commit after full history reset"

# Step 4: Delete old main and replace it with the new one
git branch -D main
git branch -m main

# Step 5: Force push to origin.
# Run this manually after a thorough review!
# git push origin main --force

echo "✅ History reset complete. 'origin/main' now has a fresh start."
```