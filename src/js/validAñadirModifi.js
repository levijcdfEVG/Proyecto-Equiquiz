document.querySelector('.formPersonajes').addEventListener('submit', async function (event) {
    event.preventDefault();

    /*Recoger elementos del formulario*/
    const nombre = document.querySelector('[name="nombre"]');
    const edad = document.querySelector('[name="edad"]');
    const genero = document.querySelector('[name="genero"]');
    const img = document.querySelector('[name="imagen"]');
    const descripcion = document.querySelector('[name="descripcion"]');

    /*Variable para comprobar*/
    let valid=true;

    if(!nombre.value){
        alert("Inserte un nombre al personaje");
        valid=false;
    }

    if(!edad.value){
        alert("Inserte una edad al personaje");
        valid=false;
    }

    if(!genero.value){
        alert("Inserte un genero al personaje");
        valid=false;
    }

    if(!descripcion.value){
        alert("Inserte una descripcion al personaje");
        valid=false;
    }

    const formatoValido = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    if (img.files.length === 0) {
        alert("Por favor, sube una imagen del personaje.");
        valid = false;
    } else if (!formatoValido.includes(img.files[0].type)) {
        alert("Por favor, sube un archivo de imagen válido (JPEG, PNG, GIF, JPG).");
        valid = false;
    }

    if(valid){
        const formData = new FormData();
        formData.append("nombre", nombre.value);
        formData.append("edad", edad.value);
        formData.append("genero", genero.value);
        formData.append("descripcion", descripcion.value);
        formData.append("img", img.files[0]);

        try {
            const response = await fetch('../app/index.php', {//Llamar al index concatenando un modelo y un controlador
                method: 'POST',
                body: formData
            });
            const result = await response.text();
        } catch (error) {
            console.error('Error:', error);
        }
    }

})
    



