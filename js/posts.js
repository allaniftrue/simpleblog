$(document).ready(function(){
    $('[id=edit],[id=delete]').tooltip({
        placement:'top'
    });

    /* delete post */
    $('[id=delete]').on('click',function(){
        var conf=confirm('Are you sure you want to completely remove post?');
        if(conf) {
           var $this = $(this);
           var dataId = $this.attr('data-id');
           $.ajax({
                    type:'POST',
                    url:[base_url,'admin/posts/delete'].join(''),
                    dataType:"json",
                    data:{id:dataId},
                    success: function(response) {
                        $('#myModalLabel').empty().append('Result');
                        if(response.status == 1) {
                            $this.closest('tr').hide('slow',function(){ $(this).remove(); });
                        }else {
                            $('.modal-body').empty().append('<p>Unable to process your request.</p>');
                            $('#myModal').modal('show');
                        }
                    },
                    error: function() {
                        $('#myModalLabel').empty().append('Result');
                        $('.modal-body').empty().append('<p>Unable to process your request.</p>');
                        $('#myModal').modal('show');
                    }
          });
        } return false;
    });
});