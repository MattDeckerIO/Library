You can use the git update-index command to temporarily ignore changes to a tracked file. Here's how you can do it:

Mark the file to be ignored:
- `git update-index --assume-unchanged <file>`

To start tracking changes again:
- `git update-index --no-assume-unchanged <file>`

To see all the files that are marked as "assume unchanged" using the following command:
- `git ls-files -v | grep '^[a-z]'`
