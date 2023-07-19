const first_password = document.querySelector("input[name='new_password']")
const second_password = document.querySelector("input[name='confirm_password']")
const settingsForm = document.querySelector("#settingsForm")
const feedback = document.querySelector('.feedback')

settingsForm.addEventListener('submit', e => {
    if(first_password.value !== second_password.value){
        e.preventDefault()
        const message = 'Passwords did not match'
        feedback.innerText = message
        feedback.classList.add('failure')
    } 
})

const password_inputs = [first_password, second_password]

document.querySelectorAll('form input').forEach(formInput => {
    formInput.addEventListener('input', () => {
        feedback.classList.remove('failure')
        feedback.classList.remove('success')
    })
})