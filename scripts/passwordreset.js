const resetPasswordBtn = document.querySelector('#resetPasswordBtn')
const verifyPasswordResetOverlay = document.querySelector('#verifyPasswordResetOverlay')

resetPasswordBtn.addEventListener('click',()=>{
    verifyPasswordResetOverlay.style.display = 'flex'
})

verifyPasswordResetOverlay.addEventListener('click',(e)=>{
    verifyPasswordResetOverlay.style.display = 'none'
})

verifyPasswordResetOverlay.querySelector('form').addEventListener('click',e=>{
    e.stopPropagation()
    // prevent click event bubbling
})

verifyPasswordResetOverlay.querySelector('.cancelBtn').addEventListener('click',e=>{
    verifyPasswordResetOverlay.style.display = 'none'
})