# Clickable Bootstrap Menu
> Bootstrap's top level navigation items are not clickable.
> This snippet makes these elements clickable.

[Source](https://stackoverflow.com/questions/53846543/how-to-make-a-bootstrap-dropdown-parent-link-clickable)


### scripts.js
```javascript
<script>
jQuery(function($) {
    $('.dropdown > a').click(function(){
        location.href = this.href;
    });
});
</script>
```
