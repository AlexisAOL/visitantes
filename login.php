<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/bootstrapSinCambios.css">
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/login.css">
      <link rel="shortcut icon" href="img/logo 2.png" type="image/x-icon">
      <title>Login</title>
   </head>
   <body class="">
      <!--se realiza el contenedor de login agregando atributos y estilos-->
      <div id="logreg-forms">
         <form class="form-signin" id="frmLogin">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Iniciar sesion</h1>
            <div class="social-login">
               <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i>Inicia sesion con Facebook</span> </button>
               <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Inicia sesion con Google</span> </button>
            </div>
            <p style="text-align:center"> ó  </p>
            <div class="input-group">
               <input type="email" id="email" name="email" class="form-control" placeholder="Correo electronico" >
            </div>
            <div class="input-group">
               <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <div class="input-group">
               <button class="btn btn-md btn-rounded btn-block form-control submit" type="submit" id="btnAcceder"><i class="fas fa-sign-in-alt"></i> Iniciar Sesion</button>
            </div>
            <div id="mensaje"></div>
            <a href="#" id="forgot_pswd">Olvidaste tu contraseña?</a>
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Registrarse</button>
         </form>
         <form action="#" class="form-reset">
            <input type="email" id="resetEmail" class="form-control" placeholder="Correo electronico" required="" autofocus="">
            <button class="btn btn-primary btn-block" type="submit">Reestablecer Contraseña</button>
            <a href="#" id="cancel_reset"><i class="fas fa-angle-left " style="color:red"></i> Volver</a>
         </form>
         <form  class="form-signup" id="frmNuevo" method="post">
            <div class="social-login">
               <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Iniciar sesion con Facebook</span> </button>
            </div>
            <div class="social-login">
               <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Iniciar sesion con Google</span> </button>
            </div>
            <p style="text-align:center">ó</p>
            <input type="hidden" name="accion" value="nuevoUsuario">
            <input type="text" id="nombreN" name="nombreN" class="form-control" placeholder="Nombre:"required="" autofocus="">
            <input type="text" id="apellidosN" name="apellidosN" class="form-control" placeholder="Apellidos:" required="" autofocus="">
            <input type="tel" id="tel" name="telefono" class="form-control" required="" placeholder="Teléfono:" autofocus="" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
            <label for="fechaN" class="form-label">Fecha de Nacimiento:</label>
            <input type="date" id="fechaN" name="fechaN" class="form-control" placeholder="Fecha de Nacimiento" required="" autofocus="">
            <input type="email" id="emailN" name="emailN" class="form-control" required="" placeholder="Correo Electrónico:" autofocus="">
            <input type="password" id="passwordN" name="passwordN" class="form-control" placeholder="Contraseña" required="" autofocus="">
            <input type="password" id="confirmarP" name="confirmarP" class="form-control" placeholder="Confirmar Contraseña" required="" autofocus="">
            <select name="categoria" id="categoria" class="form-select" aria-label=".form-select">
               <option value="" selected disabled>Selecciona una categoría</option>
               <option value="1">Admin</option>
               <option value="2">Normal</option>
            </select>
            <div class="mensaje2"></div>
            <div class="input-group">
               <button class="btn btn-md btn-block submit"id="btnCrear" type="submit"><i class="fas fa-user-plus" ></i> Registrarse</button>
            </div>
            <a href="#" id="cancel_signup"><i class="fa fa-angle-left"></i> Volver</a>
         </form>
         <br>
      </div>
      <!--se agregan las rutas de los elementos JS que se escribiran para el codigo-->
      <script src=""></script>
      <script src="js/jquery-3.6.0.min.js"> </script>
      <script src="js/jquery.validate.js"></script>
      <script>
function toggleResetPswd(e) {
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e) {
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(() => {
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})
$("#btnCrear").on("click", function() {
    //adiere una validacion al formulario Login


    $('#frmNuevo').validate({
        //agrega reglas para la validacion
        rules: {
            nombreN: {
                required: true,
                minlength: 1,
                maxlength: 50,
                email: false,
            },
            apellidosN: {
                required: true,
                minlength: 1,
                maxlength: 50,

            },
            passwordN: {
                required: true,
                minlength: 8,
                maxlength: 50,
            },
            apellidosN: {
                required: true,
                minlength: 1,
                maxlength: 50,
            },
            emailN: {
                required: true,
                minlength: 1,
                maxlength: 50,
                email: true,

            },
            telefono: {
                required: true,



            },
            confirmarP: {
                required: true,
                minlength: 8,
                maxlength: 50,
                equalTo: "#passwordN",
            },
            fechaN: {
                required: true,
                minlength: 1,
                maxlength: 50,

            },
            categoria: {
                required: true,


            },


            //se establecen los mensajes que se enviaran si no se cumplen las reglas
        },
        messages: {
            nombreN: {
                required: "No puede quedar vacio.",
                minlength: "Longitud invalida, al menos {0}",
                maxlength: "Longitud invalida, maximo {0}",
                email: false,
            },
            apellidosN: {
                required: "No puede quedar vacio.",
                minlength: "Longitud invalida, al menos {0}",
                maxlength: "Longitud invalida, maximo {0}",

            },
            passwordN: {
                required: "No puede quedar vacio.",
                minlength: "Longitud invalida, al menos {0}",
                maxlength: "Longitud invalida, maximo {0}",
            },
            apellidosN: {
                required: "No puede quedar vacio.",
                minlength: "Longitud invalida, al menos {0}",
                maxlength: "Longitud invalida, maximo {0}"
            },
            emailN: {
                required: "No puede quedar vacio.",
                minlength: "Longitud invalida, al menos {0}",
                maxlength: "Longitud invalida, maximo {0}",
                email: "Ingresa una direccion de correo valida",

            },
            telefono: {
                required: "No puede quedar vacio",



            },
            confirmarP: {
                required: "No puede quedar vacio.",
                minlength: "Longitud invalida, al menos {0}",
                maxlength: "Longitud invalida, maximo {0}",
                equalTo: "Las contraseñas no son iguales",
            },
            fechaN: {
                required: "No puede quedar vacio.",


            },
            categoria: {
                required: "No puede quedar vacio.",


            },
        },
        errorElement: "span",
        errorClass: "color-rojo col-12",
        //ejecuta una funcion asociada al login en caso de generar un error
        submitHandler: function() {

            var login = $('#frmNuevo').serialize();

            $.ajax({
                //manda los atributos dentro de un ajax
                url: 'php/usuarioAction.php',
                data: login,
                type: 'POST',
                //si se ejecuta correctamente el ajax se realizara la siguiente funcion teniendo como parametro r
                success: function(r) {
                    //condicion que evalua si la contraseña es incorrecta y asocia a una constante un fragmento de codigo html

                    if (r == 'F') {
                        alert('Esta direccion de correo ya existe');
                        const msg = "<div class='alert alert-danger'><b>Usuario</b> y/o <b>contraseña incorrecta</b></div>"
                        // al elemento con id mensaje le asigna la constante msg y le indica que es codigo html
                        $("#mensaje2").html(msg);
                    } else {
                        // si la contraseña es correcta te dirige a la carpeta admin donde apareceras dentro del index
                      
                        document.location.href = "/visitantes/lista/";
                    }
                }

            });


        }

    });
});
//---------------------------------------------------------------------------------------
//crea un apuntador al id btnAcceder el cual ejecutara una funcion al dar click sobre el elemento
$("#btnAcceder").on("click", function() {
    //adiere una validacion al formulario Login

    $('#frmLogin').validate({
        //agrega reglas para la validacion
        rules: {
            email: {
                required: true,
                minlength: 8,
                maxlength: 50,
                email: true,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 50,
            },
            //se establecen los mensajes que se enviaran si no se cumplen las reglas
        },
        messages: {
            email: {
                required: "Este campo es obligatorio.",
                minlength: "debe ser maximo {0} caracteres ",
                maxlength: "debe ser minimo {0} caracteres",
                email: "Por favor ingresa una direccion de correo valida.",
            },
            password: {
                required: "Este campo es obligatorio.",
                minlength: "debe ser maximo {0} caracteres ",
                maxlength: "debe ser minimo {0} caracteres",
            },
        },
        errorElement: "span",
        errorClass: "color-rojo col-12",
        //ejecuta una funcion asociada al login en caso de generar un error
        submitHandler: function() {

            var login = $('#frmLogin').serialize();
            $.ajax({
                //manda los atributos dentro de un ajax
                url: 'php/usuarioAction.php',
                data: login,
                type: 'POST',
                //si se ejecuta correctamente el ajax se realizara la siguiente funcion teniendo como parametro r
                success: function(r) {
                    //condicion que evalua si la contraseña es incorrecta y asocia a una constante un fragmento de codigo html
                    console.log(r);
                    if (r == 'F') {
                        const msg = "<div class='alert alert-danger'><b>Usuario</b> y/o <b>contraseña incorrecta</b></div>"
                        // al elemento con id mensaje le asigna la constante msg y le indica que es codigo html
                        alerta(msg);
                    } else {
                        // si la contraseña es correcta te dirige a la carpeta admin donde apareceras dentro del index
                        document.location.href = "/visitantes/lista/";
                    }
                }

            });


        }

    });
});

function alerta(msg) {
    $("#mensaje").html(msg);
    $("#mensaje").fadeIn(300, function() {
        setTimeout(function() {
            $("#mensaje").fadeOut(300);
        }, 2000);
    });
}
    </script>
</body>
</html>