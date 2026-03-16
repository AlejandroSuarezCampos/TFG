function togglePass(inputId, iconoId){
    let input=document.getElementById(inputId);
    let icono=document.getElementById(iconoId);
    
    if(input.type=="password"){
        input.type="text";
        icono.classList.replace('bi-eye', 'bi-eye-slash');
    }else{
        input.type="password";
        icono.classList.replace('bi-eye-slash', 'bi-eye');
    }
}