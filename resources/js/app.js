require('./bootstrap');

//Canal Publico
/* Echo.channel('notifications')
    .listen('UserSessionChanged',(e)=>{
        const notificationElement = document.getElementById('notifications');
        notificationElement.innerText = e.message; //Asignamos el mensaje

        notificationElement.classList.remove('invisible');//Eliminamos las clase para agregar la interaccion
        //Borramos las clases para dejar el elemento en su estado original
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');

        //Agregamos la clase cuando el usuario se loguea o cierra sesión dependiendo el tipo
        notificationElement.classList.add('alert-' + e.type);

    }); */


// Canal privado
Echo.private('notifications')
    .listen('UserSessionChanged',(e)=>{
        const notificationElement = document.getElementById('notifications');
        notificationElement.innerText = e.message; //Asignamos el mensaje

        //Eliminamos las clase para agregar la interaccion
        notificationElement.classList.remove('invisible');
        //Borramos las clases para dejar el elemento en su estado original
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');

        //Agregamos la clase cuando el usuario se loguea o cierra sesión dependiendo el tipo
        notificationElement.classList.add('alert-' + e.type);

    });
