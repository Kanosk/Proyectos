$(document).ready (function(){
    //este efecto es para que el menu aparezca descendiendo
   $('.menu a').each(function(index,elemento){
    $(this).css({
        'top':'-200px'
    })
    $(this).animate({
        'top':'0'
    },2000 +(index * 500))
   });
   //este es para verificar si el tamaño es correcto y hacer una animacion con el titulo
   if($(window).width()>800){
    $('header .textos').css({
        opacity:0,
        marginTop:0
    })
    $('header .textos').animate({
        opacity:1,
        marginTop:'-52px'
    },1500)
   }

   //para que funcionen los botones
   var acercaDe=$('#acerca-de').offset().top;
   var menu=$('#platillos').offset().top;
   var galeria=$('#galeria').offset().top;
   var ubicacion=$('#ubicacion').offset().top;
   $('#btn-acerca-de').on('click',function(e){
    e.preventDefault;
    $('html, body').animate({
        scrollTop:acercaDe -150
    },500)
   })
   
   $('#btn-menu').on('click',function(e){
    e.preventDefault;
    $('html, body').animate({
        scrollTop:menu
    },500)
   })
   
   $('#btn-galeria').on('click',function(e){
    e.preventDefault;
    $('html, body').animate({
        scrollTop:galeria
    },500)
   })
   
   $('#btn-ubicacion').on('click',function(e){
    e.preventDefault;
    $('html, body').animate({
        scrollTop:ubicacion
    },500)
   })
});