
var htmlLoader = $('#loader');
$('#pwModal').on('show.bs.modal', (e)=> {
    $('#cont').html();
    showEmailForm();
    $('#errMail').hide();
});

let eyeOff = $('.eye-off').html(), eye = $('.eye').html();

$('.pass-view').on('click', ()=> {
    $('.pass-form').attr('type') == 'password'
    ?
    ($('.pass-form').attr('type','text'),
    $('.pass-view').html(eyeOff))
    :
    ($('.pass-form').attr('type','password'),
    $('.pass-view').html(eye));
});

$(document).on('click','#send',function(){
    var email = $('#email').val();
    if(email != ''){
        $('#cont').html(htmlLoader);
        setTimeout(function(){
            email != '' && $.ajax({
                type : "POST",
                url : baseUrl+"login/checkEmail",
                data : {
                    email : email
                },
                success : function (res){
                    if(res == 1){
                        $('#cont').html(`
                            <div class="alert alert-primary m-3" role="alert">
                                Password telah dikirim ke alamat e-mail anda, silahkan periksa kotak masuk email anda!
                            </div>
                        `);
                    }
                    else{
                        showEmailForm();
                        $('#errMail').show();
                    }
                }
            });
        },500);
    }
});

function showEmailForm(){
    $('#cont').html(`
        <div class="modal-body">
            <div class="container-fluid">
                <div class="form-group" id="inputEmail">
                    <label for="email">Masukan Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="example@mail.com" required>
                    <small id="errMail" class="form-text text-danger">Email tidak terdaftar!</small>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-secondary ml-auto" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="send">Submit</button>
                </div>
            </div>
        </div>
    `);
}