function goLogin()
{
    var connect, user, pass, session,form, response, result;
    //Obtener los valores del formulario
    user = __('user').value;
    pass = __('pass').value;
    session = __('session').checked? true: false;

    form = 'user='+user+'&pass='+pass+'&session='+session;
    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    connect.onreadystatechange = function ()
    {
        if(connect.readyState == 4 && connect.status == 200)
        {
            if(connect.responseText == 1)
            {
                //Conectado
                // se redirecciona
                result="<div>Estas adentro</div>";
                __('mensaje').innerHTML = result;
                 location.reload();
                //
            }else{
                // mensaje de error datos incorrecto (desde php)
                mensaje = "Algo salio mal";
               // __('mensajes').innerHTML = mensaje;
                __('mensaje').innerHTML = connect.responseText;
                
            }
        }else if(connect.readyState !=4 )
        {
            // procesando
            result="<div>Estamos trabajando...</div>";
            __('mensaje').innerHTML = connect.responseText;
        }
    
    }
    
    connect.open('POST','usuarios/login', true);
    connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    connect.send(form); 
}


function runLogin(e)
{
    if(e.KeyCode == 13){ goLogin();}
}



function ajax()
{
    var connect,datos, response, result;
    var rta_php, msj_ok, msj_error;
    var url;

    connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    connect.onreadystatechange = function ()
    {
        /*  Value	State	Description
            0	UNSENT	Client has been created. open() not called yet.
            1	OPENED	open() has been called.
            2	HEADERS_RECEIVED	send() has been called, and headers and status are available.
            3	LOADING	Downloading; responseText holds partial data.
            4	DONE	The operation is complete.
        */

        if(connect.readyState == 4 && connect.status == 200)
        {
            respuesta_php = 1;
            mensaje_ok ="Todo bien";
            if(connect.responseText == rta_php)
            {
                alert(result);
                __('mensaje').innerHTML = msj_ok;
                location.reload();
            }else{
                msj_error = "Algo salio mal";
                __('mensajes').innerHTML = mensaje;

                // la sig linea muestra errores php inclusive
                // usar solo en desarrollo
                //__('mensajes').innerHTML = connect.responseText;
            }
        }else if(connect.readyState !=4 )
        {
            // procesando 
            result="<div>Estamos cargando...</div>";
            __('mensajes').innerHTML = result;
        }
    
    }
    connect.open('POST','usuarios/login', true);
    connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    connect.send(form); 

}