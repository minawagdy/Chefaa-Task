 @extends('layoutsWep.main')

@section('content')
<div class="container">
<br />
<div class="row">
<div class="col-md-6">
<input type="text" name="full_text_search" id="search" class="form-control" placeholder="Search" value="">
</div>

</div>
<br />
<div class="table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Product</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>
</div>

<script>
$(document).ready(function(){
load_data('');
function load_data(search = '')
{
$.ajax({
url:"{{url('api/getProduct')}}",
method:"POST",
data:{search:search},
dataType:"json",
success:function(data)
{
var output = '';
if(data.length > 0)
{
for(var count = 0; count < data.length; count++)
{
output += '<tr>';
output += '<td><a href="{{url('productDetails')}}/'+data[count].id+'">'+data[count].title+'</a></td>';
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
