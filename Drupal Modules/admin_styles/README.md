# Admin Styles Module

The Admin Styles module allows you to inject custom CSS styles into your Drupal admin theme without overriding the theme itself. This module is particularly useful for site builders who want to make minor style adjustments to the admin interface without creating a sub-theme.

## Installation

1. Copy the `admin_styles` directory to your site's `modules/custom` directory.
2. Navigate to Extend (`/admin/modules`) and enable the "Admin Styles" module.

## Usage

To add custom styles to the admin theme, follow these steps:

### 1. Add Your CSS File

Place your CSS file in the `css` directory of the `admin_styles` module. You can name it `admin-styles.css` or choose another name, but make sure to update the `.module` file accordingly.

### 2. Edit Your CSS File

Open the CSS file and add the custom styles you want to apply to the admin theme. You can target specific classes, IDs, or elements.

```css
/* Example: Change the background color of the admin header */
#admin-header {
  background-color: #f5f5f5;
}
