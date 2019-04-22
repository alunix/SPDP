(function(){

$('.form-prevent-double-submits').on('submit',function(){
    $('.double-submit-prevent').attr('disabled','true');
})

})();