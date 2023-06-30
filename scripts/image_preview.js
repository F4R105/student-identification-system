const inputFile = document.querySelector("input[type='file']")
const profileImageContainer = document.querySelector("#profile_image")
const profileImage = profileImageContainer.querySelector('img')
const placeholder = profileImageContainer.querySelector('span')

inputFile.addEventListener('change',()=>{
    const file = inputFile.files[0]

    if(file){
        const reader = new FileReader()
        placeholder.style.display = 'none'
        profileImage.style.display = 'block'

        reader.addEventListener('load',()=>{
            profileImage.setAttribute('src', reader.result)
        })

        reader.readAsDataURL(file)
    }else{
        profileImage.removeAttribute('src')
        profileImage.style.display = 'none'
        placeholder.style.display = 'block'
    }
})