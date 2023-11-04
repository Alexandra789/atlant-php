const invoice = document.querySelector('#invoice');
const typeDoc = document.querySelector('#typeDoc');
const addRecordBtn = document.querySelector('.add-record-btn');
const formBtn = document.querySelector('.add-record-btn');
const form = document.querySelector('.form-add-record');

let errorArray = {};

invoice.oninput = function (e) {
    checkIsNumValue(e);
};

typeDoc.oninput = function (e) {
    checkIsNumValue(e);
};

function checkIsNumValue(e) {
    const helperText = e.target.parentElement.querySelector('.invalid-feedback');
    if (!isNaN(e.target.value)) {
        delete errorArray[e.target.name];
        removeError(helperText);
    } else {
        errorArray[e.target.name] = helperText.innerText;
        addError(helperText);
    }

    function addError(helperText) {
        helperText.classList.remove('d-none');
        addRecordBtn.classList.add('disabled');
    }

    function removeError(helperText) {
        helperText.classList.add('d-none');
        console.log(Object.keys(errorArray).length)

        if (Object.keys(errorArray).length === 0) {
            addRecordBtn.classList.remove('disabled');
        }
    }
}

// form.addEventListener('submit',(e)=>{
//
//
// })

// form.addEventListener('submit', (e) => {
//     e.preventDefault();
//     setTimeout(e.stopPropagation,5000)
//     console.log(e)
//     if (Object.keys(errorArray).length === 0) {
//         form.submit();
//         form.reset();
//     }
// })