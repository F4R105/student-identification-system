const first_password = document.querySelector("input[name='new_password']")
const second_password = document.querySelector("input[name='confirm_password']")
const settingsForm = document.querySelector("#settingsForm")
const feedback = document.querySelector('.feedback')

document.querySelectorAll('form input').forEach(formInput => {
    formInput.addEventListener('input', () => {
        feedback.classList.remove('failure')
        feedback.classList.remove('success')
    })
})

settingsForm.addEventListener('submit', e => {

    if(first_password.value !== second_password.value){
        e.preventDefault()
        const message = 'Passwords did not match'
        feedback.innerText = message
        feedback.classList.add('failure')
        return
    } 

    if(first_password.value.length < 6){
        e.preventDefault()
        const message = 'Password should contain 6 or more characters'
        feedback.innerText = message
        feedback.classList.add('failure')
        return
    } 

    if(
        !/[a-z]/.test(first_password.value) ||
        !/[A-Z]/.test(first_password.value) ||
        !/[0-9]/.test(first_password.value)
    ){
        e.preventDefault()
        const message = 'Password should contain numbers, small and capital letters'
        feedback.innerText = message
        feedback.classList.add('failure')
        return
    } 
})