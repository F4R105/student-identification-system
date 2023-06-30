const deleteGuardBtn = document.querySelector('#deleteGuardBtn')
const verifyGuardDeleteOverlay = document.querySelector('#verifyGuardDeleteOverlay')

deleteGuardBtn.addEventListener('click',()=>{
    verifyGuardDeleteOverlay.style.display = 'flex'
})

verifyGuardDeleteOverlay.addEventListener('click',(e)=>{
    verifyGuardDeleteOverlay.style.display = 'none'
})

verifyGuardDeleteOverlay.querySelector('#dialog').addEventListener('click',e=>{
    e.stopPropagation()
    // prevent click event bubbling
})

verifyGuardDeleteOverlay.querySelector('.cancelBtn').addEventListener('click',e=>{
    verifyGuardDeleteOverlay.style.display = 'none'
})