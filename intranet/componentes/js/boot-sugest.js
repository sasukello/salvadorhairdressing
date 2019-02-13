(function() {
    /**
     * 测试(首次从 URL 获取数据)
     */

    /**
     * 测试(首次从 URL 获取数据，显示 header，不显示按钮，忽略大小写，可清除)
     */
    $("#testNoBtn").bsSuggest({
        url: "data.json",
        /*effectiveFields: ["userName", "shortAccount"],
        searchFields: [ "shortAccount"],*/
        effectiveFieldsAlias:{userName: "姓名"},
        ignorecase: true,
        showHeader: true,
        showBtn: false,     //不显示下拉按钮
        delayUntilKeyup: true, //获取数据的方式为 firstByUrl 时，延迟到有输入/获取到焦点时才请求数据
        idField: "userId",
        keyField: "userName",
        clearable: true
    }).on('onDataRequestSuccess', function (e, result) {
        console.log('onDataRequestSuccess: ', result);
    }).on('onSetSelectValue', function (e, keyword, data) {
        console.log('onSetSelectValue: ', keyword, data);
    }).on('onUnsetSelectValue', function () {
        console.log("onUnsetSelectValue");
    });

    /**
     * 从 data参数中过滤数据
     */
    var dataList = {value: []}, i = 5001;
    while(i--) {
        dataList.value.push({
            id: i,
            word: Math.random() * 100000,
            description: 'http://lzw.me'
        });
    }
    //禁用表单提交
    $("form").submit(function() {
        return false;
    });

    //版本切换
    $('#bsVersion button').on('click', function() {
        var ver = $(this).data('version');
        $('#bscss').attr('href', '//cdn.bootcss.com/bootstrap/' + ver + '/css/bootstrap.min.css');
        $('#bsjs').attr('src', '//cdn.bootcss.com/bootstrap/' + ver + '/js/bootstrap.min.js');
    });
}());
