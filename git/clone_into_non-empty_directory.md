# Clone a git repository into a non-empty directory
> This process allows you to clone a repository into a directory
> that contains files. The typically is not possible.

```bash
git init
git remote add gh <repository path>
git pull gh main --allow-unrelated-histories
```