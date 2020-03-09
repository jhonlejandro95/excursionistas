var form=document.forms[0];
var regex = /^([0-9]*$)/;
//control login usuarios
form.addEventListener('submit', function (e) {
    var documento=form.elements['documento'].value;
    var descripcion=form.elements['descripcion'].value;
    var peso=form.elements['peso'].value;
    var calorias=form.elements['calorias'].value;
    if(documento == "" || descripcion== ""|| peso== ""|| descripcion== ""|| calorias=="" ){
       alert("por favor verifica que todos los campos esten llenos");
       e.preventDefault();
       if(documento == ""){
           form1.elements["documento"].focus(); 
       }else
           if( descripcion == "" ){
               form1.elements['descripcion'].focus(); 
           }else
                if( peso == "" ){
                    form1.elements['peso'].focus(); 
                }
                else
                    if( calorias== "" ){
                        form1.elements['calorias'].focus(); 
                    }
    }
});
