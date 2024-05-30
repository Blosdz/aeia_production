@extends('layouts.app')

@section('content')
     <div class = "gpt3__blog">
         <section id="myEvents" >
         </section>

         <section id="futureEvents" >
             
         </section>

         <section id="pastEvents"  >
             
         </section>
      </div>
@endsection

<link rel="stylesheet" type="text/css" href="{{ url('test.css') }}"/>

    {-- <script type="module" src="testEvent/test.js"></script>--}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    //import {show} from './dialog.js';
    /*
   const Article = ({ imgUrl, date, title,description,link_meet }) => (
    <div  >
        
        <div >
            <img  alt="blog_image" />
        </div>

        <div  >
            <div>
                <p>{date}</p>
                <h3>{title}</h3>
                <h3>{description}</h3>
            </div>
            <button id="ww">{link_meet}</button>

        </div>
    </div>
    );

   */
    const data = [
    {
        id: 1,
        img:
        'https://images-na.ssl-images-amazon.com/images/I/81eB%2B7%2BCkUL._AC_UL200_SR200,200_.jpg',
        title: 'I Love You to the Moon and Back',
        author: 'Amelia Hepworth',
    },
    {
        id: 2,
        img:
        'https://images-na.ssl-images-amazon.com/images/I/71aLultW5EL._AC_UL200_SR200,200_.jpg',
        title: 'Our Class is a Family',
        author: 'Shannon Olsen',
    },
    {
        id: 3,
        img:
        'https://images-na.ssl-images-amazon.com/images/I/71e5m7xQd0L._AC_UL200_SR200,200_.jpg',
        title: 'The Vanishing Half: A Novel',
        author: 'Brit Bennett',
    },
    ];

    
    function loadEvents()
    {    
        //alert("ssass");  

        let userFullnames = data.map(function(element){

            type = document.createElement("button");
            type.setAttribute("class", "gpt3__blog_container_groupB");
            type.appendChild(document.createTextNode("wwww"));
            document.getElementById("myEvents").appendChild(type);
            
            alert(element.title+""+element.author);
             
        })

          
    }

     /*
    var url = "event/event.js";
    $.getScript(url, function(){
        event("getScript");
          
    });
    */
        
</script> 
<style>

.gpt3__blog_container {
    display: flex;
    flex-direction: row;
    margin: 3rem;

}

.gpt3__blog {
    display: flex;
    flex-direction: column; 
    background:   rgb(94, 95, 148);

   
}
.gpt3__blog_container_groupB {
    flex: 1;

    display:grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 2rem;
}
</style>
<script type="text/javascript">

  
    
 //import {show} from './dialog.js';
     
    function checkloaded(obj)
    {
        if("header_1" === obj)
        {
            var body = document.getElementById("body_1");
            checkProperty(body);
        }
    }
    function checkProperty(body)
    {
        if(body.style.display === 'none')
        {
          body.style.display = "block";
        }
        else{
          body.style.display = "none";
        }
    }

        
</script>