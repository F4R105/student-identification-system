const scanBtn = document.querySelector('#scanBtn')
const scannerInput = document.querySelector('#scannerInput')
const scannerResults = document.querySelector('#scannerResults')
const scannerProgress = document.querySelector('#scannerProgress')

const showStudentInfo = (student) => {
    scannerProgress.style.display = 'none'
    scannerInput.blur()

    const studentInfoHTML = `
    <div>
        <div id="resultHeader">
            <div id="studentImageContainer">
                <img src="../../store/students_photos/${student.profile_picture}" alt="">
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM625 177L497 305c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L591 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                <h1>Approved</h1>
            </div>
        </div>
        <table>
            <tr>
                <td class="key">Fist Name</td>
                <td>${student.first_name}</td>
            </tr>
            <tr>
                <td class="key">Last Name</td>
                <td>${student.last_name}</td>
            </tr>
            <tr>
                <td class="key">Course</td>
                <td>${student.course}</td>
            </tr>
            <tr>
                <td class="key">Admission Number</td>
                <td>${student.admission_number}</td>
            </tr>
        </table>
    </div>
    `

    const template = document.createElement("template")
    template.innerHTML = studentInfoHTML.trim()
    scannerResults.appendChild(template.content.firstElementChild)
    scannerResults.style.display = 'flex'

    setTimeout(()=>{
        scannerResults.style.display = 'none'
        scannerResults.innerHTML = ''
        scannerInput.focus()
        scannerInput.value = ''
        scannerProgress.style.display = 'block'
        scannerProgress.innerText = `Waiting for scan!..`
    },2000)
}

const fetchStudentInfo = async (admissionNumber) => {

    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ admission_number: admissionNumber })
    }

    try {
        scannerProgress.innerText = `Loading`
        const res = await fetch('../../process/studentInfo_api.php', options)
        if(res.status !== 200){
            scannerInput.value = ''
            const error = await res.json()
            return alert(error.message)
        }

        const studentInfo = await res.json()
        showStudentInfo(studentInfo)
    }catch(error){console.error(error)} 

}

scannerInput.addEventListener('change', () => {
    fetchStudentInfo(scannerInput.value)
})

// ------- OVERLAY START
const scannerOverlay = document.querySelector('#scannerOverlay')
const scannerInfo = scannerOverlay.querySelector('#scannerInfo')

scanBtn.addEventListener('click',()=>{
    scannerOverlay.style.display = 'flex'
    scannerProgress.style.display = 'block'

    scannerResults.innerHTML= ''
    scannerResults.style.display = 'none'

    scannerInput.focus()
    scannerInput.value = ''

    scannerProgress.innerText = `Waiting for scan!..`

    // setTimeout(()=>{
    //     fetchStudentInfo('20051013032')
    // }, 2000)
})

scannerOverlay.addEventListener('click',(e)=>{
    scannerOverlay.style.display = 'none'
})

scannerInfo.addEventListener('click',e=>{
    e.stopPropagation()
})
// -------- OVERLAY ENDS