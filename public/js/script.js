document.addEventListener('DOMContentLoaded', function () {

  // Transition fluide effet
  let article = document.querySelector(".top_article");
  setTimeout(() => {
    article.classList.add("top_article-visible");
  }, 200); // Petit délai pour un effet plus fluide de 200ms

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
    let isHided = true
    btnCriteria.setAttribute('value', 'Plus de critères')
    btnCriteria.addEventListener('click', (e) => {
      e.stopPropagation()
      if (isHided) {
        btnCriteria.removeAttribute('value')
        btnCriteria.setAttribute('value', 'Moins de critères')
        isHided = false
      } else {
        btnCriteria.removeAttribute('value')
        btnCriteria.setAttribute('value', 'Plus de critères')
        isHided = true
      }
      coachCriteriaSelect.forEach(function (criteria) {
        criteria.classList.toggle('switch')
      })
    })
  }
})
