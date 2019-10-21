var single = new Dropdown({
    dom: 'singleSelect',//点击触发下拉的选择框的id
    type: 'single',//是单选还是多选 单选 single 多选 multiple
    title: '单选请选择',//选择框title
    required: true,//是否必填 true:必填 ，false : 非必填
    requiredTip: '当前为必填项', // required为true，用户没有选择的提示文案
    dataArr: [
      {
        id: '1',
        cont: '不限'
      },
      {
        id: '2',
        cont: '一室'
      },
      {
        id: '3',
        cont: '二室'
      },
      {
        id: '4',
        cont: '三室'
      },
      {
        id: '5',
        cont: '四室及以上'
      }
    ],//选择的选项数据，为3的倍数，不足用 '' 代替
    success: function (resp) { // 回调函数
      console.log(resp)
      if(resp.length>0){
        $('#singleSelect').val(resp[0].cont)
      }
    }
  })
