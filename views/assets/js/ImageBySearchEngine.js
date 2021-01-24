class ImageBySearchEngine{

    constructor()
    {

        window.addEventListener("load", ()=>{

            this.addEventListenerFormSubmit();

        });

    }



    addEventListenerFormSubmit()
    {

        let form_search = document.getElementById("form_search");

        form_search.addEventListener("submit", (event)=>{

            event.preventDefault();
            this.search();

        });

    }

    setIsLoading( option )
    {

        if(option){

            $("#containerLoading").show();
            $("#result").hide(400);


        } else {

            $("#containerLoading").hide();
            $("#result").show(400);


        }

    }

    handleError()
    {

        this.setIsLoading(false);

    }

    handleSuccess( data )
    {

        this.setIsLoading(false);

        let rawTemplate = document.getElementById("templateResults").innerHTML;
        let compiledTemplate = Handlebars.compile( rawTemplate );
        document.getElementById("result").innerHTML = compiledTemplate(data);

    }

    search()
    {

        this.setIsLoading( true );

        let params = {

            query: document.getElementById("query").value,
            limit: document.getElementById("limit").value,
            search_engine: document.getElementById("search_engine").value

        };

        let ajax = axios.create();
        ajax.get("/controllers/search.php", {

            params

        })
        .then(( response )=>{

            this.handleSuccess( response.data );

        })
        .catch((error)=>{

            this.handleError( error.response.data );

        });

    }

}

const imageBySearchEngine = new ImageBySearchEngine();
