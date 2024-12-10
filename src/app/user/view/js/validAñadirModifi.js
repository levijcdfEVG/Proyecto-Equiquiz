document.querySelector("form").addEventListener("submit", function(event){
    //Evitar que el formulario se envíe automaticamente
    event.preventDefault();

    //Obtener campos del formulario
    const nombre = document.querySelector("[name='nombre']");
    const edad = document.querySelector("[name='edad']");
    const genero = document.querySelector("[name='genero']:checked");
    const img = document.querySelector("[name='imagen']");
    const descripcion = document.querySelector("[name='descripcion']");

    let valid = true;
    //Campo nombre no este vacío
    if(!nombre.value){
        alert("Introduce el nombre del personaje");
        valid = false;
    }

    //Campo edad no este vacío
    if(!edad.value){
        alert("Introduce la edad del personaje");
        valid = false;        
    }

    //Verificar que se haya seleccionado un genero
    if(!genero){
        alert("Introduce el género del personaje");
        valid = false;  
    }   
    
    //Campo descripcion no este vacío
    if(!descripcion.value){
        alert("Introduce una descripción del personaje");
        valid = false;        
    }

    //Verificar que se haya seleccionado un archivo
    if(!img.files.length){
        alert("Selecciona una imagen");
        valid = false;
    } else {
        const tiposPermitidos = ['image/jpeg', 'image/jpg', 'image/png'];
        if(!tiposPermitidos.includes(img.files[0].type)) {
            alert("Tipo de archivo no permitido. Solo se permiten imágenes JPEG, JPG y PNG");
            valid = false;
        }
    }

    if(valid) {
        event.target.submit();
    }
})
