document.addEventListener('DOMContentLoaded', () => 
{

    const form = document.getElementById('registration-form');
    const container = document.getElementsByClassName("container")[0];
    const errorMessage =  document.getElementsByClassName("error-status")[0];

    const formHandler = (event) => 
    {
        event.preventDefault()
        
        const formData = new FormData( event.target );
        
        /* TODO: Обработка формы */
        /*
        if(formData.get("reg_login") == "" || formData.get("reg_password") == "")
        {
            document.getElementsByClassName("error-message")[0].style.display = "block";

            container.style.height = "434px";
            errorMessage.innerHTML = "Поля не могут быть пустыми!";

            return;
        }

        if(formData.get("reg_password").length < 4)
        {
            document.getElementsByClassName("error-message")[0].style.display = "block";

            container.style.height = "434px";
            errorMessage.innerHTML = "Пароль должен содержать не менее 4 символов!";

            return;
        }
        */
        fetch('/db/register/index.php', 
        {
            method: "POST",
            header: {
                "Content-Type": "application/json; charset=utf-8"
            }, 
            body: formData,
        }).then(function(response) {
            return response.text();
        }).then(function(data) {
            console.log(data);
        });

        window.location.href = '../';
    }
      
    form.addEventListener('submit', formHandler);
})