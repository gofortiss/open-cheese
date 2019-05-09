<table id="table"></table>
<script type="text/javascript">
  $(document).ready(function(){
    $('#table').bootstrapTable({
      search: true,
      columns: [ {
        field: 'name',
        title: 'Item Name'
      }, {
        field: 'price',
        title: 'Item Price'
      }],
      data: [{

        name: 'Item 1',
        price: '$1'
      }, {

        name: 'Item 2',
        price: '$2'
      }]
    })
  });
</script>
