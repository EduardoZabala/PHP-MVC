function updateModalTarget(){

    const selectElement = document.getElementById('tipoUser');
    const selectedValue = selectElement.value;
    const modalButton = document.getElementById('modalButton');

    if (selectedValue === "1") {
        modalButton.setAttribute('data-target', '#studentModal');
    } else if (selectedValue === "2") {
        modalButton.setAttribute('data-target', '#profesorModal');
    }

    if (selectedValue === "1" || selectedValue === "2") {
        modalButton.style.display = 'inline-block';
    }else{
        modalButton.style.display= 'none'
    }
}