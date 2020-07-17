# Accessible reCAPTCHA
> The reCAPTCHA no-captcha functionality adds a floating div at the
> bottom right of the screen. This box is not accessible.

[Source](https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed)

### notice.html
```html
<div class="reCaptcha-notice">
  This site is protected by reCAPTCHA and the Google 
  <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and 
  <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> 
  apply.
</div>
```

### accessible-recaptcha.sass
```scss
// Hides the reCAPTCHA floating div
.grecaptcha-badge { visibility: hidden; }
```

*The guidance provided here does not constitute legal advice.*

*Please refer to Google for the most up-to-date guidance.*