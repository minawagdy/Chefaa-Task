 @extends('layoutsWep.main')

@section('content')
<div class="container">    
<br />
<div class="row">
<div class="col-md-6">
<input type="hidden" name="full_text_search" id="search" value="{{$id}}" class="form-control" placeholder="Search" value="">
</div>

</div>
<br />
<h3></h3>
<p></p>
<div class="table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Pharmacy</th>
<th>Price</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
load_data('');
function load_data(search = '')
{
   var search = $('#search').val();

$.ajax({
url:"http://localhost:8000/api/getProductDetails/"+search,
method:"GET",
data:{search:search},
dataType:"json",
success:function(data)
{
var output = '';


  $("h3").append(data[0].title);
  $("p").append(data[0].description);


if(data.length > 0)
{
for(var count = 0; count < data.length; count++)
{
output += '<tr>';
output += '<td>'+data[count].name+'</td>';
output +='<td>'+data[count].price+'</td>';
output += '</tr>';
}
}
else
{
output += '<tr>';
output += '<td colspan="6">No Data Found</td>';
output += '</tr>';
}
$('tbody').html(output);
}
});
}
$('#search').keyup(function(){
var search = $('#search').val();
load_data(search);
});
});
</script>

@endsection
