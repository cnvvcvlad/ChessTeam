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
  // Ckeditor
  ClassicEditor.create(document.querySelector('#editor')).catch((error) => {
    // console.error(error)
  })

  // Criteria
  const btnCriteria = document.getElementById('criteria')
  const coachCriteriaSelect = document.querySelectorAll('.coach-criteria')
  if (btnCriteria) {
    btnCriteria.addEventListener('click', (e) => {
      e.stopPropagation()
      coachCriteriaSelect.forEach(function (criteria) {
        criteria.classList.toggle('switch')
      })
    })
  }  
})
