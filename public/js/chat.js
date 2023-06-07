 $.ajaxSetup(
    {
     headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
    }
 );
 var form=document.getElementById("chatForm");
 var formData=new FormData(form);
 $.ajax(
        {
            url:'/chatDataPost',
            method:'POST',
            data:formData,
            dataType:'JSON',
            processData:false,
            contentType:false,
            success:function(response)
            {
                if(response.msg="success")
                {
                  $("#submitDiv").html("");
                  $("#textAreaMsg").val("");
                  var values=response.latestData;
                  values.forEach(function(data){
                      $("#submitDiv").append('<strong>'+data.commented_by+'</strong>&nbsp;&nbsp;'+moment(data.created_at).format("MMM D, hh:mm A")+"&nbsp;&nbsp;"+data.username+": "+"&nbsp;&nbsp;"+'<strong>'+data.comment+'</strong>&nbsp;&nbsp;<br/>');
                  });
                }
            },
            error:function(xhr, status, error)
            {
             //handle error
            }
        }
    );
 // }, 10000);

$("#btnSubmit").on("click",function(event)
{
 event.preventDefault();
//  alert("jklkj");
 $.ajaxSetup(
    {
     headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
    }
 );
//  alert("jkkjk");
  var data=$("#textAreaMsg").val();
//   alert(data);
 if(data)
 {
    var form=document.getElementById("chatForm");
    var formData=new FormData(form);
    //alert("hjkjhjkh");
    $.ajax(
        {
            url:'/chatData',
            method:'POST',
            data:formData,
            dataType:'JSON',
            processData:false,
            contentType:false,
            success:function(response)
            {
                if(response.msg="success")
                {
                  $("#submitDiv").html("");
                  $("#textAreaMsg").val("");
                  var values=response.latestData;
                  values.forEach(function(data){
                      $("#submitDiv").append('<strong>'+data.commented_by+'</strong>&nbsp;&nbsp;'+moment(data.created_at).format("MMM D, hh:mm A")+"&nbsp;&nbsp;"+data.username+": "+"&nbsp;&nbsp;"+'<strong>'+data.comment+'</strong>&nbsp;&nbsp;<br/>');
                  });
                }
            },
            error:function(xhr, status, error)
            {
             //handle error
            }
        }
    );
 }
});


$("#btnClear").on("click",function()
{
  $("#textAreaMsg").val("");
});

   //new Code for dropzone start
   Dropzone.autoDiscover = false;
   var dropzone = new Dropzone('#image-upload', {
        thumbnailWidth: 100,
        maxFilesize: 5,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf"
      });
   //new code for dropzone end
