'use strict'

class OrderForm
{
    constructor()
    {
        this.orderForm = $('#order-form');
        this.meal = $("#meal");
        this.mealDetails = $("#meal-details");
        this.orderSummary = $("#order-summary");
        this.validateOrder = $("#validate-order");
    
        this.basket = new Basket();
    }

    run()
    {
        this.meal.on('change', this.changeMeal.bind(this));
        this.orderForm.on('submit', this.onSubmitOrderForm.bind(this));
        this.orderSummary.on('click','button',this.deleteItem.bind(this))
        this.validateOrder.on('click', this.validateBasket.bind(this));

        this.refreshOrderSummary();
        this.meal.trigger('change');
    }

    success()
    {
        this.basket.clear();
    }

    ////////////////// ajax /////////////////////

    changeMeal()
    {
        //console.log(this.meal.val());
        $.getJSON(getRequestUrl()+'/meal?id='+ this.meal.val() ,this.onAjaxChangeMeal);
    }

    onSubmitOrderForm(event)
    {
        event.preventDefault();
        
        let id = parseInt(this.meal.val());
        let name = this.meal.children('option:selected').text();
        let price = parseFloat($('#price').text());
        let quantity = parseInt($('.quantity').val());

        this.basket.add(id,name,quantity,price)

        this.orderForm.trigger('reset');
        this.meal.trigger('change');

        this.refreshOrderSummary();

    }

    refreshOrderSummary()
    {
       

        let param={panier:this.basket.items}
        $.post(getRequestUrl()+'/basket', param, this.onAjaxShowBasket.bind(this) )      
    }

    validateBasket()
    {
        //console.log(this.basket)
        $.post(getRequestUrl()+'/order/validation', this.basket, this.onAjaxShowId)
    }


    validateOrder()
    {
        $.post(getRequestUrl()+'/order/payement/success')
    }
    ////////////////callback ajax///////////////
    
    onAjaxChangeMeal(data)
    {
        //console.log(data)
    
        $("#meal-details li img").attr("src",getWwwUrl()+'/images/meals/'+data.Photo);
        $("#description").html(data.Description);
        $('#price').html(data.SalePrice+' €');
    }

    onAjaxShowBasket(basketView)
    {
        $("#order-summary").html(basketView);
        
        if(this.basket.isEmpty() == false)
        {            
            this.validateOrder.attr("disabled", false);
        }
       else 
       {       
        this.validateOrder.attr("disabled", true);
       }
    }

    deleteItem(event)
    {
        event.preventDefault();
        //console.log($('.delete').data('index'))
        let meal = $('.delete').data('index')
        this.basket.remove(meal)
        this.refreshOrderSummary();
    }

    onAjaxShowId(orderId)
    {
        //console.log(JSON.parse(orderId))
        orderId = JSON.parse(orderId)
        window.location.href = getRequestUrl()+'/order/payement?id='+orderId;
    }
    
}