
        $(document).ready(function () {
            $("#ajaxRequest").click(function () {
                console.log('test');
                $.ajax({
                    url: "/ajax/iblockHandler.php",
                    method: "get",
                    dataType: "json",
                    data: {'action': 'addItems',
                            'limit': 2,
                            'iblockId': '1'},
                    success: function (data) {
                        console.log(data);
                    }
                })
            })
        })
