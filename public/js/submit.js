(function(){

$('.form-prevent-double-submits').on('submit',function(){
    $('.double-submit-prevent').attr('disabled','true');
})

var $submit = $("#indrecc").hide(),
$cbs = $('input[name="checkrecc"]').click(function () {
    $submit.toggle($cbs.is(":checked"));
    $('[name=indsubmit]').toggle(!$cbs.is(":checked"));
});

}
)();


  