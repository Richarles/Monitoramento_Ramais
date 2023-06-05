$(window).on('load',function (e) {
    e.preventDefault();
    listar();
  })
function listar() {    
    $.ajax({
        url: "/Controller/RamaisController.php",
        type: "GET",
        success: function(data){    
            salvar(data);
            var qtdOcupado = 0;
            var qtdChamando = 0;
            var qtdPausado = 0;
            var qtdIndisponivel = 0;
            var i;
            for(let i in data){
                var cartao ='<div id="'+data[i].status+'-cat" class="cartao">'
                    cartao +='<div>'+data[i].nome+'</div>'
                    cartao += '<div>'+data[i].call+'</div>'
                    cartao += '<span class="'+data[i].status+' icone-posicao"></span>'
                    cartao += '</div>'
                 
                if (data[i].status == 'indisponivel') {
                    if(data.hasOwnProperty(i)) {
                        qtdIndisponivel++;
                    }
                    $('.indisponivel-lista ul').append('<li class="list-group-item" id="indisponivel-t">'+cartao+'</li>')                   
                }
                if (data[i].status == 'pausado') {
                    if(data.hasOwnProperty(i)) {
                        qtdPausado++;
                    }
                    $('.pausado-lista ul').append('<li class="list-group-item">'+cartao+'</li>')
                }
                if (data[i].status == 'chamando') {
                    if(data.hasOwnProperty(i)) {
                        qtdChamando++;
                    }
                    $('.chamando-lista ul').append('<li class="list-group-item">'+cartao+'</li>')
                }
                if (data[i].status == 'ocupado') {
                    if(data.hasOwnProperty(i)) {
                        qtdOcupado++;
                    }
                    $('.ocupado-lista ul').append('<li class="list-group-item">'+cartao+'</li>')
                }
                                   
                $("div #indisponivel-cat").css( "background-color", "grey" );
            }

            $('.list-group-flush').append(`<li class="list-group-item" id="qtdOcupado"><strong>Ocupado: </strong >${qtdOcupado}</li>
                                           <li class="list-group-item" id="qtdChamando"><strong>Chamando: </strong >${qtdChamando}</li>
                                           <li class="list-group-item" id="qtdPausado"><strong>Pausado: </strong >${qtdPausado}</li>
                                           <li class="list-group-item" id="qtdIndisponivel"><strong>Indisponivel: </strong >${qtdIndisponivel}</li>`)
                                      
            setTimeout(() => {
                window.location.reload();
            }, "10000")
        },
        error: function(error){
            console.log("Errouu!",error.responseText)
        }
    });
}
  
function salvar(params) {
    $.ajax({
        url: "/classes/cadastrar.php",
        type: "POST",
        data: params,
        success: function(data){    
            console.log('teste',data);    
            editar(data);  
        },
        error: function(error){
            console.log("Errouu!",error.responseText)
        }
    });
}

function editar(params) {
    $.ajax({
        url: "/classes/cadastrar.php",
        type: "PUT",
        data: params,
        success: function(data){    
            console.log('teste',data);      
        },
        error: function(error){
            console.log("Errouu!",error.responseText)
        }
    });
}
  
    