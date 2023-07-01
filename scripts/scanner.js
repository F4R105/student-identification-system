const scanBtn = document.querySelector('#scanBtn')
const scannerInput = document.querySelector('#scannerInput')
const scannerResults = document.querySelector('#scannerResults')
const scannerProgress = document.querySelector('#scannerProgress')

const showStudentInfo = (student) => {
    scannerProgress.style.display = 'none'
    scannerInput.blur()

    const studentInfoHTML = `
    <div>
        <div id="studentImageContainer">
            <img src="../../store/students_photos/${student.profile_picture}" alt="">
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
})

scannerOverlay.addEventListener('click',(e)=>{
    scannerOverlay.style.display = 'none'
})

scannerInfo.addEventListener('click',e=>{
    e.stopPropagation()
})
// -------- OVERLAY ENDS