// STEPS
const step1 = document.querySelector('#step1')
const step2 = document.querySelector('#step2')
const step3 = document.querySelector('#step3')

// NEXT BTNS
const step1nextBtn = document.querySelector('#step1nextBtn')
const step2nextBtn = document.querySelector('#step2nextBtn')

// BACK BTNS
const step2backBtn = document.querySelector('#step2backBtn')
const step3backBtn = document.querySelector('#step3backBtn')

// FORM WIDTH
const form = document.querySelector('.multistep')
// const formWidth = getComputedStyle(form).getPropertyValue('--form-width')
const formWidth = "350px"

// PROFILE PICTURE UPLOADING
const imagePicker = document.querySelector('#image_picker')

// EVENTS

imagePicker.addEventListener('click',()=>{
    dpInputFile.click()
})

step1nextBtn.addEventListener('click',(e)=>{
    e.preventDefault()
    step1.style.left = `-${formWidth}`
    step2.style.left = "0"
})

step2nextBtn.addEventListener('click',(e)=>{
    e.preventDefault()
    step2.style.left = `-${formWidth}`
    step3.style.left = "0"
})

step2backBtn.addEventListener('click',(e)=>{
    e.preventDefault()
    step2.style.left = `${formWidth}`
    step1.style.left = "0"
})

step3backBtn.addEventListener('click',(e)=>{
    e.preventDefault()
    step3.style.left = `${formWidth}`
    step2.style.left = "0"
})
