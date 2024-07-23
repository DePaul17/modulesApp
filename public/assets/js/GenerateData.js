const form = document.querySelector(".generateData");

function submitForm(){
    form.submit();
    //alert("ça marche");
}

setInterval (submitForm, 3000);