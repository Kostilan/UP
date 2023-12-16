$(document).ready(function() {
  let modalRegister = document.getElementById('modalRegister');
  let modalLogin = document.getElementById('modalLogin');
  let modalCloseRegister = document.getElementById('modal-close-register');
  let modalCloseLogin = document.getElementById('modal-close-login');
  let mBodyRegister = document.getElementById('m_body_register');
  let mBodyLogin = document.getElementById('m_body_login');

  function showRegisterModal() {
      modalRegister.style.display = 'block';
  }

  function showLoginModal() {
      modalLogin.style.display = 'block';
  }

  $(document).on("click", "#registerLink", showRegisterModal);
  $(document).on("click", "#loginLink", showLoginModal);

  modalCloseRegister.addEventListener("click", function() {
    // modalRegister.style.transform = 'scale(0.9)';
        modalRegister.style.display = 'none';
        // mBodyRegister.innerHTML = "";
});

modalCloseLogin.addEventListener("click", function() {
        modalLogin.style.display = 'none';
        // mBodyLogin.innerHTML = "";
});
});


  $(document).ready(function() {
    let bodyAccount = document.getElementById('bodyAccount');
  
    function sendHtml(event) {
        event.preventDefault();
        
        $.ajax({
          url: this.href,
          method: 'GET',
          success: function(response) {
            console.log(response);
            bodyAccount.innerHTML = response;
          },
          error: function(error) {
            console.error('Error:', error);
          }
        });
      }
    $(document).on("click", "#accountUser, #accountBookmark, #accountBooks", sendHtml); // Привяжет обработчик событий к документу и будет срабатывать для всех элементов с id "login" и "sign", даже если они добавлены динамически.
  
    // modalClose.addEventListener("click", function() {
    //   modal.style.display = 'none';
    //   m_body.innerHTML = "";
    // });  
  });