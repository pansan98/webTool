<script>
    document.addEventListener('DOMContentLoaded', function() {
        var endpoint = "<?php echo e($endpoint); ?>";
        var el = document.querySelector('.sortable-items');
        var sortable = Sortable.create(el, {
            handle: '.sortable-drag',
            draggable: ".sortable-item",
            dataIdAttr: 'data-id',
            animation: 150,
            onSort: function(evt){
                sortable.disabled = true;
                var data = {
                    order: this.toArray()
                };
                $.ajax(endpoint, {
                    type: "GET",
                    data: data,
                }).done(function(data){
                    //
                }).fail(function(jqXHR, textStatus){
                    console.log(textStatus);
                });
            }
        })

    });
</script>