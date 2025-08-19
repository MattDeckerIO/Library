# BackstopJS

### As a docker container
1. docker pull backstopjs/backstopjs:6.3.23
1. Add to ~/.zshrc or ~/.bashrc
`backstop='docker run --rm -v $(pwd):/src backstopjs/backstopjs:6.3.23 --config=backstop.config.js'`
1. Run `source ~/.zshrc` or `source ~/.bashrc`
1. Load BackstopJS configuration as backstop.config.js in website folder.
1. Run `backstop reference` to take reference screenshots
1. Run `backstop test` to compare a test environment to the reference screenshots
1. Open `backstop_data/html_report/index.html` to review diff.

## Usage
1. We recommend first reviewing the screenshots of a one-scenario test. e.g. `backstop test --filter=test --env=prd` to ensure BackstopJS can access the target environment.
1. Run a reference job: e.g. `backstop reference --env=prd`
1. Run a one-scenario test against the other environment. e.g. `backstop test --filter=test --env=dev` to ensure BackstopJS can access the target environment.
1. Run a test job: `backstop test --env=dev`