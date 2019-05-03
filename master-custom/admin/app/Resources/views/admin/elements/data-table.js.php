<?php

?>
$.extend($.fn.dataTable.defaults, {
    language: {url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"}
});

(function () {
    var basePath = '<?php echo e($basePath); ?>';

    table = $('#table_id').DataTable({
        language: {
            processing: '<span>データ取得中...<i class="fa fa-spinner fa-pulse"></i></span>',
            lengthMenu: "表示件数 : _MENU_",
            zeroRecords: "データ無し",
            info: " _TOTAL_ 件中 _START_ 件から _END_ 件まで表示",
            infoEmpty: " 表示可能なデータが存在しませんでした",
            infoFiltered: "（全 _MAX_ 件より抽出）",
            infoPostFix: "",
            search: "検索:",
            url: "",
            paginate: {
                first: "先頭",
                previous: "前へ",
                next: "次へ",
                last: "最終"
            },
        },
        paging: true,
        info: true,
        stateSave: true,
        lengthChange: true,
        lengthMenu: [
            [3, 5, 10, 25, 50, 75, 100, 250, 500],
            ["3件", "5件", "10件", "25件", "50件", "75件", "100件", "250件", "500件"]
        ],
        displayLength: 10,
        searching: false,
        //sScrollX: true,
        autoWidth: false,
        bStateSave: true,
        bProcessing: true,
        bServerSide: true,
        ordering: true,
        order: [[1, 'asc']],
        orderCellsTop: true,
        columnDefs: [{
            orderable: false,
            targets: [-1]
        }],
        dom: '<"top"lip>rt<"bottom"i><"clear">',
        ajax: {
            url: basePath + 'json',
            dataSrc: 'data'
        },
        aoColumns: [
            <?php $view['stack']->output('data-table-column'); ?>
        ]
        , createdRow: function (row, data, dataIndex) {
            if (data["public_status"] == "9") {
                $(row).addClass('gray02');
            }
        }
        /**
         * レスポンシブWebデザイン
         */
        //responsive: true
    })
    table.on('draw', function () {
        table_resize();
    });
    $(window).on('load resize', function () {
        table_resize();
    });
}());