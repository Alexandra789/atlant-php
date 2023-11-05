const invoiceInputs = document.querySelectorAll('.form-control-invoice');
const typeDocInputs = document.querySelectorAll('.form-control-typedoc');
const addRecordBtn = document.querySelectorAll('.validate-btn');

let errorArray = {};

invoiceInputs.forEach(invoice => {
    invoice.oninput = function (e) {
        console.log(e);
        checkIsNumValue(e);
    };
})

typeDocInputs.forEach(typeDoc => {
    typeDoc.oninput = function (e) {
        checkIsNumValue(e);
    };
})

function checkIsNumValue(e) {
    const helperText = e.target.parentElement.querySelector('.invalid-feedback');
    const btn = e.target.parentElement.parentElement.parentElement.querySelector('.validate-btn');
    if (!isNaN(e.target.value)) {
        delete errorArray[e.target.name];
        removeError(helperText, btn);
    } else {
        errorArray[e.target.name] = helperText.innerText;
        addError(helperText, btn);
    }

    function addError(helperText, btn) {
        helperText.classList.remove('d-none');
        btn.classList.add('disabled');
    }

    function removeError(helperText, btn) {
        helperText.classList.add('d-none');
        console.log(Object.keys(errorArray).length);

        if (Object.keys(errorArray).length === 0) {
            btn.classList.remove('disabled');
        }
    }
}
