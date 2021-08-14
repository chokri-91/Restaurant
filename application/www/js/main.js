'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function()
{
    if(typeof(OrderForm) != 'undefined')
    {
        var orderForm = new OrderForm();

        const orderStep = $('[data-order-step]').data('order-step');
    
        if(orderStep == 'run')
        {
            orderForm.run();
        }
        else if(orderStep == 'success')
        {
            orderForm.success();
        }
    }
    

    ///////////// vérification des inputs du formulaire /////////////
    
    let form = $('form[data-validate]');


    if(form.length != 0)
    {
        var formValidator = new FormValidator(form);
        formValidator.run();
    }
});
