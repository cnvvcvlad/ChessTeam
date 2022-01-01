document.addEventListener('DOMContentLoaded', function () {
  // Recaptcha
  if (document.getElementById('recaptchaResponse')) {
    grecaptcha.ready(function () {
      grecaptcha
        .execute('6LcgZ-oUAAAAAKdW6gHFYFBm7Qx-d52XntvALZma', {
          action: 'homepage',
        })
        .then(function (token) {
          document.getElementById('recaptchaResponse').value = token
        })
    })
  }

  ClassicEditor.create(document.querySelector('#editor')).catch((error) => {
    // console.error(error)
  })
})
