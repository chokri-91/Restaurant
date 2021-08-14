class FormValidator 
{
    constructor(form)
    {
        this.form            = form;
        //recupérer la balise pour afficher les meassage d'erreur
        this.errorMessage    = form.find('.error-message');

        //recupérer la balise pour afficher le nombre des meassage d'erreur
        this.totalErrorCount = form.find('.total-errors');

        // Tableau général de toutes les erreurs de validation trouvées.
        this.totalErrors = null;
    }
    
    checkRequiredFields()
    {
        // Création d'un tableau contenant les erreurs trouvées.
        let errors = [];

        // Boucle de recherche de tous les champs de formulaires requis.
        this.form.find('[data-required]').each(function()
        {
            /*
            * La méthode jQuery each() change la valeur de la variable this :
            * elle représente tous les objets DOM sélectionnés.
            *
            * Pour notre cas elle représente donc tour à tour chaque champ de
            * formulaire trouvé avec la méthode jQuery find().
            */

            // Récupération de la valeur du champ du formulaire (sans les espaces).
            let value = $(this).val().trim();

            // Est-ce que quelque chose a été saisi ?
            if(value.length == 0)
            {
                // Non, alors que le champ est requis, donc il y a une erreur.
                errors.push(
                {
                    fieldName : "Le champ " + $(this).data('name'),
                    message   : 'est obligatoire'
                });
            }
        });

        // Copie des erreurs trouvées dans le tableau général des erreurs.
        $.merge(this.totalErrors, errors);
    }

    checkDataTypes()
    {
        let errors = [];

        this.form.find('[data-type]').each(function()

        {
            let value = $(this).val().trim();
                
            if($(this).data('type') =='int')
            {
                if(isNaN(value))
                {
                    errors.push(
                    {
                        fieldName : $(this).data('name'),
                        message   : 'doit être un nombre'
                    });
                }
            }
            else
            {
                if(typeof(value) != "string")
                {
                    errors.push(
                    {
                        fieldName : $(this).data('name'),
                        message   : 'doit être un text'
                    })
    
                }
            }
            
        })
        

        // Copie des erreurs trouvées dans le tableau général des erreurs.
        $.merge(this.totalErrors, errors);
    }

    checkMinimumLength()
    {
        /* a completer */ 

        let errors = [];
        
        this.form.find('[data-min-length]').each(function()
        {
            let value = $(this).val().trim();
            let minLength = $(this).data('min-length');    
            
            if(value.length < minLength)
            {
                errors.push(
                {
                    fieldName : $(this).data('name'),
                    message   : 'doit avoir un minimum de ' + minLength + ' caractères'
                })
            }
            
        })
        

        // Copie des erreurs trouvées dans le tableau général des erreurs.
        $.merge(this.totalErrors, errors);
    }


    onSubmitForm(event)
    {
        // Recherche et effacement de la balise HTML contenant tous les messages d'erreurs.
                /* a completer */ 

        this.totalErrors=[];

        // Exécution des différentes validations.
                 /* a completer */ 

        this.checkDataTypes();
        this.checkMinimumLength();
        this.checkRequiredFields();
        
        console.log(this.totalErrors);

        // Est-ce que des erreurs ont-été trouvées ?
        //si oui les afficher
        if(this.totalErrors.length != 0)
        {
            event.preventDefault();
            $('.error-message').find('p').empty()
            $('.error-message').append("<strong class='total-errors'> </strong> <br>")

            this.totalErrors.forEach(element => {                
                $('.error-message').find('p').append
                (
                    "Le champs<strong> " + element.fieldName + "</strong>" + ' ' + element.message + '<br>'
                );

                this.totalErrorCount.text(this.totalErrors.length);
            });

            if(this.totalErrors.length > 0)
            {
                this.errorMessage.fadeIn();
            }
        }

         /* a completer */ 
    }

    run()
    {
        // Installation d'un gestionnaire d'évènement sur la soumission du formulaire.
        this.form.on('submit', this.onSubmitForm.bind(this))
         /* a completer */
        
        if(this.errorMessage.find('p').text().trim() != '')
        {
            this.errorMessage.fadeIn();
        }
        
    }
}