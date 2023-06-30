const overlayFeedback = document.querySelector('#overlayFeedback')

overlayFeedback.addEventListener('click',(e)=>{
    overlayFeedback.style.display = 'none'
})

overlayFeedback.querySelector('#dialog').addEventListener('click',e=>{
    e.stopPropagation()
    // prevent click event bubbling
})