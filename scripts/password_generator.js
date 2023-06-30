const psd_gens = document.querySelectorAll('.psd_gen')

const generateTemporaryPassword = () => {
    let randomNumbers = []
    for( let i = 0; i < 4; i++ ){
        randomNumbers.push(Math.floor(Math.random() * 10))
    }
    
    return randomNumbers.join('')
}

for(let psd_gen of psd_gens){
    const button = psd_gen.querySelector("button")

    button.addEventListener('click',(e)=>{
        e.preventDefault()
        const input = e.target.parentElement.querySelector("input[readonly]")
        const tempPsd = generateTemporaryPassword()
        input.value = tempPsd
    })
}