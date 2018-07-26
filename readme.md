# Web Base - Bootstrap 4

You can use this base to develop your website using the most up-to-date CDNs:
- [Bootstrap 4 (CSS and JS)](https://getbootstrap.com/)
- [jQuery (JS)](http://jquery.com/)
- [Scrollreveal (JS)](https://scrollrevealjs.org/)
- [Font Awesome (JS)](https://fontawesome.com/)

## Changelog
### v1.0.5 [WIP]
	- core.css added - file which includes all core classes, (margin, padding, carousel-indicators), to see more please review /assets/css/core.css file.
	- Clases h2-bigger, h3-bigger, h4-bigger, h5-bigger, h6-bigger added.
	- Styles for h5 and h6 added to core.css
	- Classes migration from mlr to mx-, mtb to my-, plr to px-, and ptb to py-
	- Admin page and blog module added if website requires them, else you can delete the "admin" folder.
	- Some changes and improvements on admin backend.
	- Login variable on admin now is refreshed each time the user navigates through the page instead of having a default value.
### v1.0.4
- Absolute Paths Code optimized to work on Localhost with VHosts and localhost and Production Server without `$production` variable.
- "Margin" and "Padding" custom classes have now the same syntax as bootstrap (pt-60, pt-45, pt-30, etc).
- CSS px coverted to rem.
- Slug Code to make custom paths (example: `http://www.domain-name.com/blog/blog-name`).

### v1.0.3
- Code to make absolute paths in src attribute (example: `http://www.domain-name.com/assets/img/img_name.jpg`).
- Font Files from font-awesome deleted.
- Navbar CSS Fixes.
- .gitignore updated.

### v1.0.2:
- Added classes that are used recurrently (margin, padding, h1, h2, h3, h4, contianer-custom, among ohters).
- `<head>` tag now is inside of `structure/head.php` with a variable called `$view_name` to put page name (interior name) and `$page` is to indicate the website name that is developing.

### v1.0.1:
- Head tags updated with bootstrap-validator.js, font-awesome.css and required lines to enable Responsive Design on mobile devices.

---

### .gitignore
You should not worry about if you copy one of these files in the project, gitignore has the necessary code to ignore them:

```
# COMPILED SOURCE #
###################
*.com
*.class
*.dll
*.exe
*.o
*.so

# PACKAGES #
############
# it's better to unpack these files and commit the raw source
# git has its own built in compression methods
*.7z
*.dmg
*.gz
*.iso
*.jar
*.rar
*.tar
*.zip

# LOGS AND DATABASES #
######################
*.log
*.sql
*.sqlite

# OS GENERATED FILES #
######################
.DS_Store
.DS_Store?
._*
.Spotlight-V100
.Trashes
ehthumbs.db
Thumbs.db
```