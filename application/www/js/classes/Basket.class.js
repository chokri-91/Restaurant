'use strict';

class Basket
{

    constructor()
    {
        this.items = null;
        this.load();
    }

    load()
    {
        this.items = loadDataFromDomStorage("panier");

        if(this.items == null)
            this.items = [];       
    }

    save()
    {
        saveDataToDomStorage("panier",this.items )
    }


    add(id,name,quantity,price)
    {
        var data={id:id, name:name, quantity:quantity, price:price}
        
        let trouve = false;
        this.items.forEach(element => {
            
            if(id == element.id)
            {
                element.quantity+=quantity
                trouve = true;
            }
        });

        if(trouve == false)
        {
            this.items.push(data);
        }
        
        this.save();
    }

    remove(mealId)
    {
        
        this.items.forEach(element => {
            
            if(mealId == element.id)
            {
               this.items.splice(element,1)
            }
        });
        this.save();
    }

    clear()
    {
       this.items = [];
       this.save();
    }

    isEmpty()
    {
        return (this.items.length == 0);
    }


}