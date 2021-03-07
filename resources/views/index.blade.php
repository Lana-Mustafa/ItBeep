@extends('layout')
@section('main')
    
<div class="container">
    <div class="row ">
        <div class="col-2 col-sm-2 col-md-2"></div>
        <div class="col-8 col-sm-8 col-md-8"> 
            
            <div class="card-body mt-5 " style="background: #fff">
                <div class="text-center">
                    <img src="https://itbeep.com/assets/images/logo_dark.png" class="rounded  img-fluid" alt="...">
                  </div>
              <form>
                <div class="form-group">
                    <label for="InputName">Name</label>
                    <input id="name" type="text" class="form-control" placeholder="Enter Your Name">  
                  </div>
                  <div class="form-group">
                    <label for="InputName">Mobile</label>
                    <input id="mobile" type="text" class="form-control"   placeholder="Enter Your Mobile">  
                  </div>
                <div class="form-group">
                  <label for="InputEmail1">Email address</label>
                  <input id="email" type="email" class="form-control" placeholder="Enter Your Email ">  
                </div>
                
                <button id="send" onclick= save() type="button" class="btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#serviceModal">
                  Send</button>
               </form>
           </div>
       </div>
       <div class="col-2 col-sm-2 col-md-2"></div>
      </div>
  </div>

  
<!-- Services Modal -->
<div class="modal fade bd-example-modal-lg" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel " aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="serviceModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        <div id="services"> </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="next" type="button" class="btn btn-primary" data-toggle="modal" data-target="#interestModal" data-dismiss="modal">
          Next
        </button>
      </div>
    </div>
  </div>
</div>




<!-- Interest Modal -->
<div class="modal fade" id="interestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id ="interests"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
      <script>
        // $(document).on("click", "#but_fetchall", function() {
        //     console.log("clicked");
        // });
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // Fetch all records
        $(document).ready(function() {
            $(document).one("click", "#send", function() {
                console.log("clicked");
                // AJAX GET request
                $.ajax({
                    url: 'getServices',
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        createRows(response);
                        console.log(response);
                        function createRows(response) {
                            var len = 0;
                            $('#empTable tbody').empty(); 
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var name = response['data'][i].name;
                                    var tr_str =
                                          `<button  key="${name}" class="btn m-3 col-3  btn-info service-item" >${name}</button>`
                                        // name;
                                    $("#services").append(tr_str);
                                }
                            }
                        }
                    }
                });
            });
        });
    </script>
    <script>
      // $(document).on("click", "#but_fetchall", function() {
      //     console.log("clicked");
      // });
      // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      // Fetch all records
      $(document).ready(function() {
          $(document).one("click", "#next", function() {
              console.log("clicked");
              // AJAX GET request
              $.ajax({
                  url: 'getInterests',
                  type: 'get',
                  dataType: 'json',
                  success: function(response) {
                      createRows(response);
                      console.log(response);
                      function createRows(response) {
                          var len = 0;
                          $('#empTable tbody').empty(); 
                          if (response['data'] != null) {
                              len = response['data'].length;
                          }
                          if (len > 0) {
                              for (var i = 0; i < len; i++) {
                                  var name = response['data'][i].name;
                                  var tr_str =
                                        `<button value ="${name}" class="btn m-3 col-3  btn-info" >${name}</button>`
                                      // name;
                                  $("#interests").append(tr_str);
                              }
                          }
                      }
                  }
              });
          });
      });
      let services = [];
      $(document).on("click",".service-item",function(e){
        let item =  e.target.getAttribute("key");
        if(services.includes(item)){
       services.splice(services.indexOf(item), 1);
       $(`.service-item[key='${item}']`).removeClass(
        "btn-dark text-light"
    );
   
   }
   else{
       services.push(item);
       $(`.service-item[key='${item}']`).addClass(
        "btn-dark text-light")
   }
   console.log(services);
      })
     
  </script>
<script>

  function save (){
let name= document.getElementById('name').value; 
let mobile= document.getElementById('mobile').value; 
let email= document.getElementById('email').value;

let info = [
  name ,
  mobile,
  email
];

sessionStorage.setItem('req',JSON.stringify(info) );
  }


</script>

  @endsection