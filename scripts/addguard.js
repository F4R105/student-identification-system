const navAddGuardBtn = document.querySelector('#navAddGuardBtn')
const addGuardFormOverlay = document.querySelector('#addGuardFormOverlay')

navAddGuardBtn.addEventListener('click',()=>{
    addGuardFormOverlay.style.display = 'flex'
})

addGuardFormOverlay.addEventListener('click',(e)=>{
    addGuardFormOverlay.style.display = 'none'
})

addGuardFormOverlay.querySelector('form').addEventListener('click',e=>{
    e.stopPropagation()
    // prevent click event bubbling
})