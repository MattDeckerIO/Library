# Checkbox Limiter
> This script limits the number of checkboxes of a given fieldset.

[Source](https://stackoverflow.com/questions/19001844/how-to-limit-the-number-of-selected-checkboxes)


### scripts.js
```javascript
<script>
jQuery(document).ready(function($){
  $('fieldset input').on('change', function(evt) {
    var limit = 3;
    if($(this).closest('fieldset').find(':checked').length > limit) {
        this.checked = false;
    }
  });
});
</script>
```
