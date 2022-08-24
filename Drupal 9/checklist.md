## Drupal 9 Standard Checklist
##### Website Name: Awesome Website "AwesomeWeb"
##### Developers: Name, Name, Name
##### Reviewers: Name, Name, Name

| ENV | URL |
|:---:|-----|
| INT | http://integration.domain.com
| UAT | http://user.domain.com
| STG | http://staging.domain.com
| PRD | http://domain.com/


### Performance
| Compliant | Non-Compliant | Notes | Configuration |
|:-------:|:-------:|:-------:|-------
|         | &check; |     | "From" Address set to noreply@domain.com unless otherwise specified
|         | &check; |     | Page cache maximum age: 1 day
|         | &check; |     | Aggregate CSS enabled
|         | &check; |     | Aggregate JavaScript enabled
|         | &check; |     | Twig Debug disabled


### Configuration
| Compliant | Non-Compliant | Notes | Configuration |
|:-------:|:-------:|:-------:|-------
|         | &check; |     | Temporary directory set to /tmp
|         | &check; |     | Status page does not show any misconfigurations
|         | &check; |     | Favicon uploaded to theme folder and configured
|         | &check; |     | No overridden configuration in configuration management
|         | &check; |     | Administrators are able to upload files via UI. (editor_file)


### SEO
| Compliant | Non-Compliant | Notes | Configuration |
|:-------:|:-------:|:-------:|-------
|         | &check; |     | All pages have unique page titles
|         | &check; |     | Google Analytics installed
|         |         |     | **Pathauto**
|         | &check; |     | Pattern created and applied to every content type and vocabulary
|         | &check; |     | Default path pattern: ```[node:menu-link:parents:join-path]/[node:title]```
|         |         |     | **External Links**
|         | &check; |     | Place icon next to external and mailto links: Enabled
|         | &check; |     | Exclude links with the same primary domain: Enabled
|         | &check; |     | Open external links in a new window: Enabled
|         |         |     | **Simple XML Sitemap**
|         | &check; |     | Sitemap visible at /sitemap.xml


### Monitoring
| Compliant | Non-Compliant | Notes | Configuration |
|:-------:|:-------:|:-------:|-------
|         |         |     | **Monitoring & Logging**
|         | &check; |     | Error messages to display: none
|         | &check; |     | Database log messages to keep: 1000
|         | &check; |     | Website log reviewed for errors
|         | &check; |     | Website log shows real IP addresses
|         | &check; |     | Timestamp available at /health
|         | &check; |     | ```log_stdout``` installed and enabled
|         | &check; |     | Enable syslog with configuration: <domain_name>_drupal_9
|         | &check; |     | External monitoring configured.


### Security
| Compliant | Non-Compliant | Notes | Configuration |
|:-------:|:-------:|:-------:|-------
|         | &check; |     | Account registration limited to Administrators only, unless otherwise required.
|         | &check; |     | UID 1 account name is random; and status is blocked
|         | &check; |     | All modules updated to latest supported versions
|         | &check; |     | Check for module updates: Daily
|         | &check; |     | E-mail addresses to notify when updates are available: <you@domain.com>
|         | &check; |     | E-mail notification threshold: Only security updates
|         | &check; |     | UID 1 username is changed to something other than ‘admin’
|         | &check; |     | All elevated user accounts correlate to a single person
|         | &check; |     | Commenting disabled unless otherwise specified
|         | &check; |     | Devel disabled on production
|         | &check; |     | Spam protection applied to all exposed forms.
|         | &check; |     | Password Policy Roles: All roles that can create or edit or delete content
|         | &check; |     | Password Policy Expiration: ```Expiration: 90  Complexity: 4 History: 24 Username: 1 Length: 12```
|         | &check; |     | Force ALL passwords to change when policies are created or modified and prior to website launch.
|         | &check; |     | 2FA applied to content administrator role and above if required
|         | &check; |     | Flood protection: ```uid_only: false; ip_limit: 5; ip_window: 900; user_limit: 5; user_window: 900```
|         | &check; |     | All file upload fields limited to: ```txt, pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, jpeg, gif, png```


### POST LAUNCH
| Compliant | Non-Compliant | Notes | Configuration |
|:-------:|:-------:|:-------:|-------
|         |         |     | HTTP redirects to HTTPS.
|         |         |     | Sitemap shows production domain as base url.
|         |         |     | Sitemap submitted to Google Webmaster Tools.
|         |         |     | External monitoring confirmed receiving data.
|         |         |     | Google Analytics verified from GA dashboard.
|         |         |     | Google Analytics only shows data from the prod hostname.
|         |         |     | Website is able to send e-mails.
|         |         |     | Broken link report generated.
|         |         |     | Begin billing client for hosting.

1. Not applicable.
2. Reason why not compliant #1.
3. Reason why not compliant #2.
4. ...


##### Checklist v20220824
