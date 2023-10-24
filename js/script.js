//ejecutar funcion en el evento click
document.getElementById("btn_open").addEventListener("click", open_close_menu);
//Declaracion de variables
var side_menu = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");

//Evento para mostrar y ocultar menu
function open_close_menu(){
    body.classList.toggle("body_move");
    side_menu.classList.toggle("menu_side_move");
}
//Si el ancho de la pagina es menor a 760px, ocultar el menu al recargar la pagina
if(window.innerWidth<760){
    body.classList.add("body_move");
    side_menu.classList.add("menu_side_move");
}

//Haciendo el menu responsive (adaptable)
window.addEventListener("resize", function(){
    if (this.window.innerWidth > 760){
        body.classList.remove("body_move");
        side_menu.classList.remove("menu_side_move");
    }
    if (this.window.innerWidth < 760){
        body.classList.add("body_move");
        side_menu.classList.add("menu_side_move");
    }
});
function printe(){
    //desaparece el boton
    document.getElementById("menu").style.display='none';
    document.getElementById("volver").style.display='none';
    document.getElementById("Imprimir").style.display='none';
    
    //se imprime la pagina
    window.print();
    //reaparece el boton
    document.getElementById("menu").style.display='inline';
    document.getElementById("volver").style.display='inline';
    document.getElementById("Imprimir").style.display='inline';
    
  }
  function Validar(usuario, clave) {
    if (usuario == "") {
      $.alert({
        title: 'Mensaje',
        content: '<span style=color:red>Debes escribir el Usuario.</span>',
        animation: 'scale',
        closeAnimation: 'scale',
        buttons: {
          okay: {
            text: 'Cerrar',
            btnClass: 'btn-warning'
          }
        }
      });
      return 0;
    }
    if (clave == "") {
      $.alert({
        title: 'Mensaje',
        content: '<span style=color:red>Debes escribir la Clave.</span>',
        animation: 'scale',
        closeAnimation: 'scale',
        buttons: {
          okay: {
            text: 'Cerrar',
            btnClass: 'btn-warning'
          }
        }
      });
      return 0;
    }
    $.ajax({

      url: "validar.php",

      type: "POST",
      data: "usuario=" + usuario + "clave=" + clave,
      beforeSend: function() {
        $("#mensaje1").html("<img src='imagen/loader-small.gif'/><font color='white'>&nbsp&nbspProcesando, por favor espere...</font>");
      },
      success: function(resp) {
        $('#mensaje1').html(resp)
      }

    });

}
setTimeout(myFunction, 1000)

function myFunction() {
  
  location.href = "#";
}

